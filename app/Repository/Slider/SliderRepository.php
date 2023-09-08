<?php
namespace App\Repository\Slider;


use App\Interfaces\Slider\SliderInterface;
use App\Models\Slider;
use App\Services\MediaServices\MediaService;

class SliderRepository implements SliderInterface
{
    public function index()
    {
        return response_success(Slider::OrderbyDesc('id')->get());
    }

    public function store($request)
    {
        $image=null;
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'slider');
        }

        $item = Slider::create([
            'title' => $request->title,
            'image' => $image,
            'link' => $request->link,
        ]);
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'title' => $request->title,
            'link' => $request->link,
        ]);
        return response_success($item);
    }

    public function update_image($request,$item)
    {
        if ((new MediaService)->update_model_image($request,$item,'image','slider')){

            return response_success($item);
        }
           return response_custom_error('image file update error');
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');
    }

    public function front_index()
    {
        return response_success(Slider::where('is_active',true)->get());
    }


}
