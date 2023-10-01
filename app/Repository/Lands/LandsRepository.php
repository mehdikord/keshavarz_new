<?php
namespace App\Repository\Lands;


use App\Interfaces\Lands\LandsInterface;
use App\Services\MediaServices\MediaService;


class LandsRepository implements LandsInterface
{
    public function user_index()
    {
        $lands = auth('users')->user()->lands;
        return response_success($lands);

    }

    public function user_store($request)
    {
        $image=null;
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'users/lands');
        }
        $item = auth('users')->user()->lands()->create([
            'title' => $request->title,
            'description' => $request->description,
            'area' => $request->area,
            'location' => $request->location,
            'image' => $image
        ]);
        return response_success($item,'زمین شما با موفقیت اضافه شد');



    }

    public function user_update($item,$request)
    {

    }

    public function user_delete($item)
    {

    }

}
