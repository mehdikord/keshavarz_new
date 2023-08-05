<?php

namespace App\Http\Controllers\Manage\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\CategoriesStoreRequest;
use App\Http\Requests\Categories\CategoriesUpdateRequest;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Interfaces\Categories\CategoriesInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected CategoriesInterface $repository;

    public function __construct(CategoriesInterface $categories)
    {
        $this->repository = $categories;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(CategoriesStoreRequest $request)
    {
        return $this->repository->store($request);
    }
    public function update(Category $category,CategoriesUpdateRequest $request)
    {
        return $this->repository->update($request,$category);
    }

    public function delete(Category $category)
    {
        return $this->repository->delete($category);
    }

    public function update_image(Category $category,SingleImageUpdateRequest $request)
    {
        return $this->repository->update_image($request,$category);
    }

}
