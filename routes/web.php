<?php

use App\Models\User_Customer_Plan;
use Carbon\Carbon;
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
Route::get('test',function (){
    return event(new \App\Events\NewNewsEvent('test'));


});
Route::get('management', function () {
    return redirect('management/dashboard');
});

Route::get('management/{any}',static function (){
    return view('manage');
})->where('any','(.*)');

Route::get('/{any}', function () {
    return view('front');
})->where('any','(.*)');


