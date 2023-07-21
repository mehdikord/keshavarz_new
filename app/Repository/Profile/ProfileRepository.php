<?php
namespace App\Repository\Profile;



use App\Interfaces\Profile\ProfileInterface;

class ProfileRepository implements ProfileInterface
{
    public function manage_me()
    {
        return response_success(auth('admin')->user(),'management profile');
    }

}
