<?php

namespace App\Http\Controllers\User\Requests;

use App\Http\Controllers\Controller;
use App\Interfaces\Requests\RequestsInterface;
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
}
