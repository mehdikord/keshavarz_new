<?php

namespace App\Http\Controllers\Manage\Searches;

use App\Http\Controllers\Controller;
use App\Interfaces\Search\SearchInterface;
use App\Models\Search;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected SearchInterface $repository;

    public function __construct(SearchInterface $search)
    {
        $this->repository = $search;
    }

    public function index()
    {
        return $this->repository->index();
    }

    public function delete(Search $search)
    {
        return $this->repository->delete($search);

    }

}
