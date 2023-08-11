<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Implements\ImplementInterface;
use Illuminate\Http\Request;

class ImplementController extends Controller
{
    protected ImplementInterface $repository;

    public function __construct(ImplementInterface $implement)
    {
        $this->repository=$implement;
    }
}
