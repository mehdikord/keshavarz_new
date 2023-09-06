<?php

namespace App\Http\Controllers\Manage\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\News\NewsStoreRequest;
use App\Http\Requests\News\NewsUpdateRequest;
use App\Http\Requests\Single\SingleImageUpdateRequest;
use App\Interfaces\News\NewsInterface;
use App\Models\News;


class NewsController extends Controller
{
    protected NewsInterface $repository;

    public function __construct(NewsInterface $news)
    {
        $this->repository = $news;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function store(NewsStoreRequest $request)
    {
        return $this->repository->store($request);
    }

    public function update(News $news,NewsUpdateRequest $request)
    {
        return $this->repository->update($request,$news);
    }

    public function delete(News $news)
    {
        return $this->repository->delete($news);
    }

    public function update_image(News $news,SingleImageUpdateRequest $request)
    {
        return $this->repository->update_image($request,$news);
    }
}
