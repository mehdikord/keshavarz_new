<?php

namespace App\Http\Controllers\Manage\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthLoginRequest;
use App\Interfaces\Auth\AuthInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    private AuthInterface $repository;
    public function __construct(AuthInterface $auth)
    {
        $this->repository = $auth;
    }

    public function manage_login(AuthLoginRequest $request)
    {
        return $this->repository->manage_login($request);
    }





}
