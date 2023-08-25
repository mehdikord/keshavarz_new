<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Implements\ImplementInterface;
use App\Models\Implement;
use Illuminate\Http\Request;

class ImplementController extends Controller
{
    protected ImplementInterface $repository;

    public function __construct(ImplementInterface $implement)
    {
        $this->repository=$implement;
    }

    public function categories()
    {
        return $this->repository->categories_index();
    }

    public function implements()
    {
        return $this->repository->implement_index();
    }

    public function implements_show(Implement $implement)
    {

        return $this->repository->implement_show($implement);


    }
}
