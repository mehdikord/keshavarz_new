<?php
use Illuminate\Support\Facades\Route;


Route::prefix('news')->group(function (){

    Route::get('',[\App\Http\Controllers\Public\NewsController::class,'index']);
    Route::get('latest',[\App\Http\Controllers\Public\NewsController::class,'latest']);

});

Route::prefix('implements')->group(function (){
    Route::get('categories',[\App\Http\Controllers\Public\ImplementController::class,'categories']);
    Route::get('implements',[\App\Http\Controllers\Public\ImplementController::class,'implements']);

});

Route::get('provinces',[\App\Http\Controllers\Public\PublicController::class,'provinces']);

Route::prefix('plans')->group(function (){

    Route::get('customer',[\App\Http\Controllers\Public\PublicController::class,'plans_customer']);
    Route::get('provider',[\App\Http\Controllers\Public\PublicController::class,'plans_provider']);


});
