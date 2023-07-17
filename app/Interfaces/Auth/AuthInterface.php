<?php
namespace App\Interfaces\Auth;

interface AuthInterface
{

    //Management
    public function manage_login($request);
    public function manage_logout();

}
