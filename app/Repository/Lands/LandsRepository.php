<?php
namespace App\Repository\Lands;


use App\Http\Resources\Users\Lands\LandsIndexResource;
use App\Interfaces\Lands\LandsInterface;
use App\Services\MediaServices\MediaService;


class LandsRepository implements LandsInterface
{
    public function user_index()
    {
        $lands = auth('users')->user()->lands;

        return response_success(LandsIndexResource::collection($lands));

    }

    public function user_store($request)
    {
        $item = auth('users')->user()->lands()->create([
            'title' => $request->title,
            'description' => $request->description,
            'area' => $request->area,
            'location' => json_encode($request->location, JSON_THROW_ON_ERROR),
        ]);
        return response_success($item,'زمین شما با موفقیت اضافه شد');


    }

    public function user_update($item,$request)
    {
        if ($item->user_id !== auth('users')->id()){
            return response_custom_error('access denied');
        }
        $item->update([
            'title' => $request->title,
            'description' => $request->description,
            'area' => $request->area,
            'location' => json_encode($request->location, JSON_THROW_ON_ERROR),
        ]);
        return response_success($item,'زمین شما با موفقیت ویرایش شد');
    }

    public function user_delete($item)
    {
        if ($item->user_id !== auth('users')->id()){
            return response_custom_error('access denied');
        }
        $item->delete();
        return  response_success([],'زمین مورد نظر باموفقیت حذف شد');
    }

}
