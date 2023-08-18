<?php
namespace App\Repository\Profile;



use App\Interfaces\Profile\ProfileInterface;
use App\Services\MediaServices\MediaService;

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
        $user = auth('users')->user();
        $user->update([
            'name' => $request->name,
            'province_id' => $request->province_id,
            'city_id' => $request->city_id,
            'national_code' => $request->national_code,
            'bio' => $request->bio,
        ]);
        $user->load('province')->load('city');
        return response_success($user);

    }

    public function user_update_image($request)
    {
        $image = (new MediaService())->update_auth_user_profile($request);
        return response_success($image);
    }



}
