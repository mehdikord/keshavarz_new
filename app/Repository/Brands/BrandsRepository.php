<?php
namespace App\Repository\Brands;


use App\Interfaces\Brands\BrandsInterface;
use App\Models\Brand;
use App\Services\MediaServices\MediaService;

class BrandsRepository implements BrandsInterface
{
    public function index()
    {
        return response_success(Brand::OrderbyDesc('id')->get());
    }

    public function store($request)
    {
        $image=null;
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'brands');
        }

        $item = Brand::create([
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);
        return response_success($item);
    }

    public function update_image($request,$item)
    {
        if ((new MediaService)->update_model_image($request,$item,'image','brands')){

            return response_success($item);
        }
           return response_custom_error('image file update error');
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');
    }


}
