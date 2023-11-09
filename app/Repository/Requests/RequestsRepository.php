<?php
namespace App\Repository\Requests;

use App\Interfaces\Requests\RequestsInterface;
use App\Models\Request;
use App\Models\Request_User;
use Carbon\Carbon;
use function Laravel\Prompts\select;

class RequestsRepository implements RequestsInterface
{
    public function provider_pending()
    {
        $data = auth('users')->user()->provider_requests()->where('status',Request_User::STATUS_PENDING);
        $data->with('request.user',function ($user){
            $user->select(['id','name','phone','profile']);
        });
        $data->with('user_implement');
        $data->with('user_implement.implement');
        return response_success($data->get());
    }

    public function provider_working()
    {
        $data = Request::where("provider_id",auth('users')->id())
        ->where('status',Request::STATUS_WORKING)
        ->with('user',function ($user){
        $user->select(['id','name','phone','profile']);})
        ->with('implement')
        ->with('land')
        ->select(['id','implement_id','user_id','price','provider_id','code','user_land_id','created_at','updated_at']);


        return response_success($data->get());
    }



    public function provider_accept($request)
    {
        if ($request->user_id != auth('users')->id()){
            return response_custom_error('Unauthorized');
        }
        //check other
        if ($request->request->users()->where('status',Request_User::STATUS_ACCEPT)->exists()){
            return response_custom_error('این درخواست توسط خدمات دهنده دیگری پذیرفته شده است');
        }

        $request->request->users()->where('status','pending')->update(['status' => 'failed']);
        $request->update(['status' => 'accept']);
        $request->request()->update([
            'provider_id' => auth('users')->id(),
            'price' => $request->price,
            'status' => 'working',
        ]);
        //Send sms
        $sms = "کاربر گرامی درخواست ".$request->request->implement->name." برای زمین : ".$request->request->land->title." توسط ".auth('users')->user()->name." (".auth('users')->user()->phone.") پذیرفته شد.";
        sms_kavenegar_message($request->request->user->phone,$sms);
        return response_success([],'درخواست با موفقیت پذیرفته شد');

    }

    public function provider_reject($request)
    {
        if ($request->user_id != auth('users')->id()){
            return response_custom_error('Unauthorized');
        }

        $request->update(['status' => 'reject']);

        return response_success([],'درخواست رد شد');

    }



    public function provider_st_done($request)
    {
        if ($request->provider_id != auth('users')->id()){
            return response_custom_error('Unauthorized');
        }
        $request->update(['status' => Request::STATUS_DONE,'done_at' => Carbon::now()]);
        return response_success('','کار در حال انجام مورد نظر با موفقیت پایان یافت');
    }

}
