<?php

namespace App\Http\Controllers\Manage\Brands;

use App\Http\Controllers\Controller;
use App\Http\Requests\Brands\BrandsStoreRequest;
use App\Http\Requests\Brands\BrandsUpdateRequest;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Interfaces\Brands\BrandsInterface;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected BrandsInterface $repository;

    public function __construct(BrandsInterface $brands)
    {
        $this->repository = $brands;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(BrandsStoreRequest $request)
    {
        return $this->repository->store($request);
    }
    public function update(Brand $brand,BrandsUpdateRequest $request)
    {
        return $this->repository->update($request,$brand);
    }

    public function delete(Brand $brand)
    {
        return $this->repository->delete($brand);
    }

    public function update_image(Brand $brand,SingleImageUpdateRequest $request)
    {
        return $this->repository->update_image($request,$brand);
    }







}
