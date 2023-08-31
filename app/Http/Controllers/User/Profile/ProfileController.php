<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UserImplementEditRequest;
use App\Http\Requests\Profile\UserImplementReqRequest;
use App\Http\Requests\Profile\UserImplementUpdateRequest;
use App\Http\Requests\Profile\UserRangeUpdateRequest;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Http\Requests\Single\SingleUserProfileUpdateRequest;
use App\Interfaces\Profile\ProfileInterface;
use App\Models\User_Implement;

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
        return $this->repository->range_update($request);
    }


    public function implement()
    {
        return $this->repository->implement();

    }

    public function implement_request(UserImplementReqRequest $request)
    {
        return $this->repository->implement_request($request);

    }

    public function implement_update(UserImplementUpdateRequest $request)
    {

        return $this->repository->implement_update($request);

    }


    public function implement_edit(User_Implement $id,UserImplementEditRequest $request)
    {
        if ($id->user_id != auth('users')->id()){
            return response()->json('Unauthorised',401);
        }
        return $this->repository->implement_edit($id,$request);
    }

    public function implement_delete(User_Implement $id)
    {
        if ($id->user_id != auth('users')->id()){
            return response()->json('Unauthorised',401);
        }
        return $this->repository->implement_delete($id);
    }
}
