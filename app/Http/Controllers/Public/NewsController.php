<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\News\NewsInterface;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected NewsInterface $repository;

    public function __construct(NewsInterface $news)
    {
        $this->repository=$news;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function latest()
    {

        return $this->repository->latest();

    }


}
