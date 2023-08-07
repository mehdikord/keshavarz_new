<?php
namespace App\Repository\Products;


use App\Interfaces\Products\ProductsInterface;
use App\Models\Product;

class ProductsRepository implements ProductsInterface
{
    public function index()
    {
        $data = Product::query();
        $data->with('category');
        $data->with('brand');

        $data->orderByDesc('id');
        return response_success($data->get());
    }

    public function store($request)
    {
        $item = Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'sale' => $request->sale,
            'quantity' => $request->quantity,
            'commenting' => $request->commenting,
            'is_active' => true,
            'views' => 0,
            'sells' => 0,
        ]);
        //generate product code
        $item->update(['code' => core_random_code($item->id)]);


        $item->load('category');
        $item->load('brand');
        return response_success($item);
    }

    public function update($request,$item)
    {
        $item->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'price' => $request->price,
            'sale' => $request->sale,
            'commenting' => $request->commenting,
        ]);

        return response_success($item);
    }

    public function delete($item)
    {
        $item->delete();
        return response_success(true,'item deleted success');

    }

    public function activation($item)
    {
        $item->update(['is_active' => !$item->is_active]);
        return response_success(true,'item activation changed');
    }


}
