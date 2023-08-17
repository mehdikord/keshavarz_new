<?php
namespace App\Repository\Profile;



use App\Interfaces\Profile\ProfileInterface;

class ProfileRepository implements ProfileInterface
{
    public function manage_me()
    {
        return response_success(auth('admin')->user(),'management profile');
    }

    public function user_me()
    {
        $user = auth('users')->user();
        $user->load('province')->load('city');
        return response_success($user);
    }

    public function user_update($request)
    {

    }

    public function user_update_image($request)
    {

    }



}
