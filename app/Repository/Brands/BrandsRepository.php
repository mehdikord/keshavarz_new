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
            $image = (new MediaService())->store_image_resize($request->file('image'),500,500,'brands');
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

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');
    }


}
