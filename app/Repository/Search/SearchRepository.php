<?php
namespace App\Repository\Search;
use App\Interfaces\Search\SearchInterface;
use App\Models\Request;
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
        $users->where('is_active',true)->where('is_provider',true)->whereNotNull('search_location');
        $users->whereHas('implements',function ($implement)use($request){
            $implement->where('implement_id',$request->implement_id);
        });
        $result=[];
        $make_request=null;
        foreach ($users->get() as $user){
            $dis = location_distance(json_decode($user->search_location),$request->location);
            if ($dis <= $user->search_range){
                $user_implement = $user->implements()->where('implement_id',$request->implement_id)->first();

                if (auth('users')->user()->customer_plan_active_check()){
                    $phone = $user->phone;
                }else{
                    $phone = null;
                }

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
        if (count($result)){
            $make_request = Request::create([
                'user_id' => auth()->id(),
                'implement_id' => $request->implement_id,
                'location' => json_encode($request->location, JSON_THROW_ON_ERROR),
            ]);
            $make_request->update(['code' => core_random_code($make_request->id,16)]);
        }
        log_search_store(auth('users')->id(),$request->implement_id,$request->location,count($result));
        $make_request->load('implement');
        return response_success([
            'result' => $result,
            'request' => $make_request
        ]);

    }

    public function search_providers_request_send($request)
    {
        $get_req = Request::find($request->request_id);
        $get_user = User::find($request->user_id);
        return $get_req;

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
