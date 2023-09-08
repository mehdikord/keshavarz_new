<?php

namespace App\Http\Controllers\Manage\Implements;

use App\Http\Controllers\Controller;
use App\Http\Requests\Implements\ImplementsCategoriesStoreRequest;
use App\Http\Requests\Implements\ImplementsCategoriesUpdateRequest;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Interfaces\Implements\ImplementInterface;
use App\Models\Implement_Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected ImplementInterface $repository;

    public function __construct(ImplementInterface $implement)
    {
        $this->repository = $implement;
    }

    public function index()
    {
        return $this->repository->categories_index();
    }

    public function store(ImplementsCategoriesStoreRequest $request)
    {
        return $this->repository->categories_store($request);
    }

    public function update(Implement_Category $category,ImplementsCategoriesUpdateRequest $request)
    {
        return $this->repository->categories_update($request,$category);
    }

    public function delete(Implement_Category $category)
    {
        return $this->repository->categories_delete($category);
    }

    public function update_image(Implement_Category $category,SingleImageUpdateRequest $request)
    {
        return $this->repository->categories_update_image($request,$category);
    }
}
