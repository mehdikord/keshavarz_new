<?php
namespace App\Interfaces\Requests;

interface RequestsInterface
{

    public function provider_pending();
    public function provider_accept($request);

}
