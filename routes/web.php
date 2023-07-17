<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/{any}', function () {
    return view('front');
})->where('any','(.*)');

Route::get('management', function () {
    return redirect('management/dashboard');
});

Route::get('management/{any}',static function (){
    return view('manage');
})->where('any','(.*)');

