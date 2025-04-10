<?php
namespace App\Repository\Search;
use App\Interfaces\Search\SearchInterface;
use App\Models\Request;
use App\Models\Request_User;
use App\Models\Search;
use App\Models\User;

class SearchRepository implements SearchInterface
{
    public function index()
    {
        $data = Request::query();

        $data->with('user')->with('implement')->with('provider')->with('land');

        return response_success($data->get());
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');
    }


    //Users

    public function search_providers($request)
    {
        $users = User::query();
        $users->where('id','!=',auth('users')->id())->where('is_active',true)->where('is_provider',true)->whereNotNull('search_location');
        $users->whereHas('implements',function ($implement)use($request){
            $implement->where('implement_id',$request->implement_id);
        });
        $land = auth('users')->user()->lands()->where('id',$request->user_land_id)->first();
        $result=[];
        $make_request=null;

        if ($land && $land->location){
            //check doing same request
            if (auth('users')->user()->customer_requests()->where('user_land_id',$land->id)->where('implement_id',$request->implement_id)->where('status','pending')->exists()){
                return response_custom_error('درحال حاضر درخواستی با این اطلاعات در انتظار تایید خدمات دهنده میباشد !');
            }

            $location = json_decode($land->location, false, 512, JSON_THROW_ON_ERROR);
            if ($location->lat && $location->lng){
                $location = [$location->lat, $location->lng];
            }

            foreach ($users->get() as $user){
                $user_location =  json_decode($user->search_location, false, 512, JSON_THROW_ON_ERROR);
                if ($user_location->lat && $user_location->lng){
                    $user_location = [$user_location->lat, $user_location->lng];
                }
                $dis = location_distance($user_location,$location);

                if ($dis <= $user->search_range){
                    $user_implement = $user->implements()->where('implement_id',$request->implement_id)->first();
                    $phone = null;
                    $result[]=[
                        'dis' => $dis,
                        'price_type' => $user_implement->implement->price_type,
                        'price' => $user_implement->price,
                        'implement' => [
                            'id' => $user_implement->implement_id,
                            'name' => $user_implement->implement->name,
                            'code' => $user_implement->implement->code,
                            'image' => $user_implement->implement->image,
                            'category' => $user_implement->implement->category ?? null,
                        ],
                        'user'=>[
                            'id'=>$user->id,
                            'name'=>$user->name,
                            'phone' => $phone,
                            'image'=>$user->image,
                        ]

                    ];
                }
            }

        }
        if (count($result)){
            //Remove old requests without pending user
            auth('users')->user()->customer_requests()->whereDoesntHave('users')->delete();

            //get area
            $area = $land->area;
            if ($request->filled('area')){
                $area = $request->area;
            }

            $make_request = Request::create([
                'user_id' => auth()->id(),
                'user_land_id' => $land->id,
                'implement_id' => $request->implement_id,
                'location' => $land->location,
                'area' => $area,
                'search_result' => json_encode($result, JSON_THROW_ON_ERROR),
                'dates' => json_encode($request->dates, JSON_THROW_ON_ERROR)
            ]);
            $make_request->update(['code' => core_random_code($make_request->id,16)]);
            $make_request->load('implement');
            $make_request->load('land');

        }

//        log_search_store(auth('users')->id(),$request->implement_id,$request->location,count($result));

        return response_success([
            'result' => $result,
            'request' => $make_request
        ]);

    }

    public function search_providers_request_send($request)
    {
        $get_req = Request::find($request->request_id);
        if ($get_req->user_id != auth('users')->id()){
            return response_unauthorized();
        }
        $get_user = User::find($request->user_id);
        $user_implement = $get_user->implements()->where('implement_id',$get_req->implement_id)->first();
        if ($user_implement){
            if (Request_User::where('request_id',$get_req->id)->where('user_implement_id',$user_implement->id)->exists()){
                return response_custom_error('قبلا برای این کاربر درخواست ارسال کرده اید');
            }
            $location = json_decode($get_req->land->location, false, 512, JSON_THROW_ON_ERROR);
            if ($location->lat && $location->lng){
                $location = [$location->lat, $location->lng];
            }
            $user_location = json_decode($get_user->search_location, false, 512, JSON_THROW_ON_ERROR);
            if ($user_location->lat && $user_location->lng){
                $user_location = [$user_location->lat, $user_location->lng];
            }

            $dis = location_distance($user_location,$location);
            $req_user = $get_req->users()->create([
                'user_id' => $get_user->id,
                'user_implement_id' => $user_implement->id,
                'price' => $user_implement->price,
                'distance' => $dis,
            ]);
            $sms_message = sms_generator('provider_request',[$user_implement->implement->name]);
            sms_kavenegar_message($get_user->phone,$sms_message);
            return response_success($req_user);

        }
    }

    public function search_providers_request_show($request)
    {
        if ($request->user_id != auth('users')->id()){
            return response_custom_error('Unauthorized');
        }
        $request->load('implement');
        $request->load('land');
        $request->load('users');
        $request->load('provider');
        return response_success($request);
    }

    public function search_providers_request_user_cancel($request){

        $get_req = Request::find($request->request_id);
        $get_user = User::find($request->user_id);
        if ($get_req->user_id != auth('users')->id()){
            return response_unauthorized();
        }

        $get_req->users()->where('user_id',$get_user->id)->where('status','pending')->delete();
        return response_success('','درخواست به کاربر مورد نظر لغو گردید');
    }


    public function search_providers_request_users($request)
    {
        if ($request->user_id != auth('users')->id()){
            return response_custom_error('Unauthorized');
        }
        return response_success($request->users()->get());


    }

    public function search_providers_request_cancel($request)
    {
        if ($request->user_id != auth('users')->id()){
            return response_custom_error('Unauthorized');
        }
//        if ($request->status != 'pending'){
//            return response_custom_error('این درخواست از حالت انتظار خارح شده است');
//        }
        $request->users()->delete();
        $request->update(['provider_id' => null,'status' => Request::STATUS_CANCELED]);
        return response_success('درخواست مورد نظر باموفقیت لغو گردید');
    }

    public function search_providers_request_get_pending()
    {
        $data = auth('users')->user()->customer_requests()->where('status',Request::STATUS_PENDING);
        $data->with('implement');
        $data->with('land');
        $data->withCount('users');
        return response_success($data->get());
    }

    public function search_providers_request_get_working()
    {
        $data = auth('users')->user()->customer_requests()->where('status',Request::STATUS_WORKING);
        $data->with('implement');
        $data->with('land');
        $data->with('provider',function ($provider){
            $provider->select(['id','name','phone','profile']);
        });
        return response_success($data->get());
    }

    public function search_providers_request_get_done()
    {
        $data = auth('users')->user()->customer_requests()->where('status',Request::STATUS_DONE);
        $data->with('implement');
        $data->with('land');
        $data->with('provider',function ($provider){
            $provider->select(['id','name','phone','profile']);
        });
        return response_success($data->get());
    }

    public function search_providers_request_get_canceled()
    {
        $data = auth('users')->user()->customer_requests()->where('status',Request::STATUS_CANCELED);
        $data->with('implement');
        $data->with('land');
        $data->with('provider',function ($provider){
            $provider->select(['id','name','phone','profile']);
        });
        return response_success($data->get());
    }

    public function search_providers_request_get_actives()
    {
        $data = auth('users')->user()->customer_requests()->whereIn('status',[Request::STATUS_PENDING,Request::STATUS_WORKING]);
        $data->with('implement');
        $data->with('land');
        $data->with('provider',function ($provider){
            $provider->select(['id','name','phone','profile']);
        });
        return response_success($data->get());

    }


    public function provider_profile($user)
    {
        $implements = [];

        if (!$user->is_active){
            return response_custom_error('حساب کاربری کاربر موردنظر غیرفعال است');
        }
        if (auth('users')->user()->customer_plan_active_check()){
            $phone = $user->phone;
        }else{
            $phone = null;
        }
        $user_result = [
            'id' => $user->id,
            'name' => $user->name,
            'phone' => $phone,
            'image' => $user->profile,
            'bio' => $user->bio,
            'province' => $user->province,
            'city' => $user->city,
        ];
        foreach ($user->implements()->with('implement')->with('forms')->get() as $implement){

            $implements[]=[
                'price' => $implement->price,
                'implement' => [
                    'id' => $implement->implement->id,
                    'name' => $implement->implement->name,
                    'price_type' => $implement->implement->price_type,
                    'image' => $implement->implement->image,
                    'forms'=> $implement->forms,
                ],
                'category' => [
                    'name' => $implement->implement->category->name,
                    'image' => $implement->implement->category->image,
                ],
            ];
        }




        return response_success([
            'user' => $user_result,
            'implements' => $implements
        ]);

    }

    public function provider_gallery($user)
    {
        $data = $user->gallery()->select(['id','user_id','type','file'])->get();
        return response_success($data);

    }




}
