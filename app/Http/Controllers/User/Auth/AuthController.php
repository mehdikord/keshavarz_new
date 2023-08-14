<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\AuthUserLoginCheckRequest;
use App\Http\Requests\Auth\AuthUserLoginRequest;
use App\Interfaces\Auth\AuthInterface;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected AuthInterface $repository;

    public function __construct(AuthInterface $authRepository)
    {
        $this->repository = $authRepository;
    }

    public function login(AuthUserLoginRequest $request)
    {

        return $this->repository->user_login($request);

    }

    public function check(AuthUserLoginCheckRequest $request)
    {
        return $this->repository->user_check($request);
    }
}
