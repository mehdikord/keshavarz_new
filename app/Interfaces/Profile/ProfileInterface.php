<?php
namespace App\Interfaces\Profile;

interface ProfileInterface
{

    //Management
    public function manage_me();

    //Users
    public function user_me();

    public function user_update($request);

    public function user_update_image($request);



}
