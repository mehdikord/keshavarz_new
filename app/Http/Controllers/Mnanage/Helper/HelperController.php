<?php

namespace App\Http\Controllers\Mnanage\Helper;

use App\Http\Controllers\Controller;
use App\Models\Province;
use Illuminate\Http\Request;

class HelperController extends Controller
{
    public function provinces()
    {
        return response_success(Province::with('cities')->get());

    }
}
