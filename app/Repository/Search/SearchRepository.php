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
        return response_success(Search::with('user')->with('implement')->get());
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');
    }


    public function search_providers($request)
    {
        $users = User::query();
        $users->where('id','!=',auth('users')->id())->where('is_active',true)->where('is_provider',true)->whereNotNull('search_location');
        $users->whereHas('implements',function ($implement)use($request){
            $implement->where('implement_id',$request->implement_id);
        });
        $land = auth()->user()->lands()->where('id',$request->user_land_id)->first();
        $result=[];
        $make_request=null;
        if ($land && $land->location){
            $location = explode(',',json_decode($land->location, false, 512, JSON_THROW_ON_ERROR));
            foreach ($users->get() as $user){
                $dis = location_distance(json_decode($user->search_location),$location);
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
            $make_request = Request::create([
                'user_id' => auth()->id(),
                'implement_id' => $request->implement_id,
                'location' => json_encode($request->location, JSON_THROW_ON_ERROR),
            ]);
            $make_request->update(['code' => core_random_code($make_request->id,16)]);
            $make_request->load('implement');

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
        $get_user = User::find($request->user_id);
        $user_implement = $get_user->implements()->where('implement_id',$get_req->implement_id)->first();
        if ($user_implement){
            if (Request_User::where('request_id',$get_req->id)->where('user_implement_id',$user_implement->id)->exists()){
                return response_custom_error('قبلا برای این کاربر درخواست ارسال کرده اید');
            }
            $req_user = $get_req->users()->create([
                'user_id' => $get_user->id,
                'user_implement_id' => $user_implement->id,
                'price' => $user_implement->price,
            ]);
            return response_success($req_user);
        }
    }

    public function search_providers_request_users($request)
    {
        if ($request->user_id != auth('users')->id()){
            return response_custom_error('Unauthorized');
        }
        return response_success($request->users()->get());


    }

    public function search_providers_request_get_pending()
    {
        $data = auth('users')->user()->customer_requests()->where('status','pending');
        $data->with('implement');
        $data->withCount('users');
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
