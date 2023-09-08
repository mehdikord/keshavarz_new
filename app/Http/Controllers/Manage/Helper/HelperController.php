<?php

namespace App\Http\Controllers\Manage\Helper;

use App\Http\Controllers\Controller;
use App\Models\Province;

class HelperController extends Controller
{
    public function provinces()
    {
        return response_success(Province::with('cities')->get());

    }
}
