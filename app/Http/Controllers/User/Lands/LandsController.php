<?php

namespace App\Http\Controllers\User\Lands;

use App\Http\Controllers\Controller;
use App\Http\Requests\Lands\LandsUserStoreRequest;
use App\Interfaces\Lands\LandsInterface;
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


}
