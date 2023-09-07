<?php

namespace App\Http\Controllers\Manage\Slider;

use App\Http\Controllers\Controller;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Http\Requests\Slider\SliderStoreRequest;
use App\Http\Requests\Slider\SliderUpdateRequest;
use App\Interfaces\Slider\SliderInterface;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    protected SliderInterface $repository;

    public function __construct(SliderInterface $slider)
    {
        $this->repository = $slider;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(SliderStoreRequest $request)
    {
        return $this->repository->store($request);
    }

    public function update(Slider $slider,SliderUpdateRequest $request)
    {
        return $this->repository->update($request,$slider);
    }

    public function delete(Slider $slider)
    {
        return $this->repository->delete($slider);
    }

    public function update_image(Slider $slider,SingleImageUpdateRequest $request)
    {
        return $this->repository->update_image($request,$slider);
    }

}
