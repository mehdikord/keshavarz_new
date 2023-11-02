<?php
namespace App\Repository\Requests;

use App\Interfaces\Requests\RequestsInterface;
use App\Models\Request_User;

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

}
