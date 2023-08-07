<?php

namespace App\Http\Controllers\Manage\Products;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\ProductsStoreRequest;
use App\Http\Requests\Products\ProductsUpdateRequest;
use App\Interfaces\Products\ProductsInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductsInterface $repository;
    public function __construct(ProductsInterface $products)
    {
        $this->repository = $products;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(ProductsStoreRequest $request)
    {
        return $this->repository->store($request);
    }
    public function update(Product $product,ProductsUpdateRequest $request)
    {
        return $this->repository->update($request,$product);
    }

    public function delete(Product $product)
    {
        return $this->repository->delete($product);
    }

    public function activation(Product $product)
    {
        return $this->repository->activation($product);
    }
}
