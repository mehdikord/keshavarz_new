<?php
namespace App\Repository\Categories;



use App\Interfaces\Categories\CategoriesInterface;
use App\Models\Brand;
use App\Models\Category;
use App\Services\MediaServices\MediaService;

class CategoriesRepository implements CategoriesInterface
{
    public function index()
    {
        $data = Category::query();
        if (request()->filled('with_parent') && request('with_parent') === 'true'){
            $data->whereNotNull('parent_id');
        }
        if (request()->filled('with_parent') && request('with_parent') === 'false'){
            $data->whereNull('parent_id');
        }

        $data->orderByDesc('id');
        $data->with('parent');
        return response_success($data->get());
    }

    public function store($request)
    {
        $image=null;
        if ($request->file('image')){
            $image = (new MediaService())->store_image($request->file('image'),'categories');
        }
        $item = Category::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'image' => $image,
            'description' => $request->description,
        ]);
        $item->load('parent');
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'name' => $request->name,
            'parent_id' => $request->parent_id,
            'description' => $request->description,
        ]);
        $item->load('parent');
        return response_success($item);
    }

    public function update_image($request,$item)
    {
        if ((new MediaService)->update_model_image($request,$item,'image','categories')){

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
