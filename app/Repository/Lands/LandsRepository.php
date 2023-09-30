<?php
namespace App\Repository\Lands;


use App\Interfaces\Lands\LandsInterface;


class LandsRepository implements LandsInterface
{
    public function user_index()
    {
        $lands = auth('users')->user()->lands;

    }

    public function user_store($request)
    {

    }

    public function user_update($item,$request)
    {

    }

    public function user_delete($item)
    {

    }

}
