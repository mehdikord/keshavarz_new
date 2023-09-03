<?php
namespace App\Repository\Users;



use App\Interfaces\Users\UsersInterface;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersRepository implements UsersInterface
{
    //Managers
    public function managers_index()
    {
        return response_success(Admin::OrderbyDesc('id')->get());
    }

    public function managers_store($request)
    {
        $item = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'is_active' => 1,
            'password' => Hash::make($request->password),
        ]);
        return response_success($item);
    }

    public function managers_update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);
        return response_success($item);
    }

    public function managers_delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    //Members
    public function members_index()
    {
        return response_success(User::OrderbyDesc('id')->withCount('referrals')->get());
    }

    public function members_store($request)
    {
        $item = User::create([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'national_code' => $request->national_code,
            'phone' => $request->phone,
            'is_active' => true,

        ]);
        $item->withCount('referrals');
        return response_success($item);
    }

    public function members_update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'national_code' => $request->national_code,
            'phone' => $request->phone,
        ]);
        return response_success($item);
    }

    public function members_delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function members_activation($item)
    {
        $item->update(['is_active' => !$item->is_active]);
        return response_success(true);

    }

}
