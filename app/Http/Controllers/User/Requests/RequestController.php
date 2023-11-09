<?php

namespace App\Http\Controllers\User\Requests;

use App\Http\Controllers\Controller;
use App\Interfaces\Requests\RequestsInterface;
use App\Models\Request_User;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    protected RequestsInterface $repository;
    public function __construct(RequestsInterface $requests)
    {
        $this->repository = $requests;
    }

    public function pending()
    {
        return $this->repository->provider_pending();
    }

    public function working()
    {
        return $this->repository->provider_working();

    }

    public function accept(Request_User $request)
    {
        return $this->repository->provider_accept($request);
    }

    public function reject(Request_User $request)
    {
        return $this->repository->provider_reject($request);
    }

    public function set_done(\App\Models\Request $request)
    {
        return $this->repository->provider_st_done($request);
    }

}
