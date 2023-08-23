<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Http\Requests\Single\SingleUserProfileUpdateRequest;
use App\Interfaces\Profile\ProfileInterface;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    protected ProfileInterface $repository;
    public function __construct(ProfileInterface $profile)
    {
        $this->repository = $profile;
    }

    public function me()
    {
        return $this->repository->user_me();
    }

    public function update(SingleUserProfileUpdateRequest $request)
    {
        return $this->repository->user_update($request);
    }

    public function update_image(SingleImageUpdateRequest $request)
    {
        return $this->repository->user_update_image($request);
    }

    public function range_update(UserRangeUpdateRequest $request)
    {
        return response_success($this->repository->range_update($request));

    }
}
