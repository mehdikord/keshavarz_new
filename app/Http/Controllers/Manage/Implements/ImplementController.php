<?php

namespace App\Http\Controllers\Manage\Implements;

use App\Http\Controllers\Controller;
use App\Http\Requests\Implements\ImplementsStoreRequest;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Interfaces\Implements\ImplementInterface;
use App\Models\Implement;

class ImplementController extends Controller
{
    protected ImplementInterface $repository;

    public function __construct(ImplementInterface $implement)
    {
        $this->repository = $implement;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(ImplementsStoreRequest $request)
    {
        return $this->repository->store($request);
    }

    public function update(Implement $implement,ImplementsStoreRequest $request)
    {
        return $this->repository->update($request,$implement);
    }

    public function delete(Implement $implement)
    {
        return $this->repository->delete($implement);
    }

    public function update_image(Implement $implement,SingleImageUpdateRequest $request)
    {
        return $this->repository->categories_update_image($request,$implement);
    }
}
