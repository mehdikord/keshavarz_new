<?php

namespace App\Http\Controllers\User\Profile;

use App\Http\Controllers\Controller;
use App\Http\Requests\Single\SingleImageStoreRequest;
use App\Interfaces\Profile\ProfileInterface;
use App\Models\User_Gallery;


class GalleryController extends Controller
{

    protected ProfileInterface $repository;
    public function __construct(ProfileInterface $profile)
    {
        $this->repository = $profile;
    }


    public function index()
    {
        return response_success($this->repository->index_gallery());
    }

    public function store(SingleImageStoreRequest $request)
    {
        return response_success($this->repository->store_gallery($request));
    }

    public function delete(User_Gallery $id)
    {
        access_user_own($id->user_id);
        return response_success($this->repository->delete_gallery($id),'آیتم مورد نظر باموفقیت حذف گردید');
    }
}
