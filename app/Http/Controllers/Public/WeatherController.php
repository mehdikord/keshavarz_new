<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Interfaces\Weather\WeatherInterface;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    protected WeatherInterface $repository;
    public function __construct(WeatherInterface $weather)
    {
        $this->repository = $weather;
    }

    public function current(Request $request)
    {

        return $this->repository->current($request);

    }

    public function exclude(Request $request)
    {
        return $this->repository->exclude($request);

    }


}
