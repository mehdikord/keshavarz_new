<?php
namespace App\Interfaces\Requests;

interface RequestsInterface
{

    public function provider_pending();
    public function provider_working();
    public function provider_accept($request);
    public function provider_st_done($request);

}
