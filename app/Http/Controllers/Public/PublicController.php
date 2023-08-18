<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function provinces()
    {
        return response_success(Province::with('cities')->get());
    }
}
