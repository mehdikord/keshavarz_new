<?php

namespace App\Http\Controllers\User\Lands;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lands\LandsUserStoreRequest;
use App\Interfaces\Lands\LandsInterface;
use App\Models\User_Land;
use Illuminate\Http\Request;

class LandsController extends Controller
{
    protected LandsInterface $repository;
    public function __construct(LandsInterface $lands)
    {
        $this->repository = $lands;
    }

    public function index()
    {
        return $this->repository->user_index();
    }

    public function store(LandsUserStoreRequest $request)
    {
        return $this->repository->user_store($request);
    }

    public function update(User_Land $land, LandsUserStoreRequest $request)
    {
        return $this->repository->user_update($land,$request);

    }
    public function delete(User_Land $land)
    {
        return $this->repository->user_delete($land);
    }


}
