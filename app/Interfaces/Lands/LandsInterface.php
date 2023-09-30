<?php
namespace App\Interfaces\Lands;

interface LandsInterface
{
    public function user_index();

    public function user_store($request);

    public function user_update($item,$request);

    public function user_delete($item);

}
