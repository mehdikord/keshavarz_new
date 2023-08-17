<?php
use Illuminate\Support\Facades\Route;

//Auth
Route::prefix('auth')->group(function (){
    Route::post('',[\App\Http\Controllers\User\Auth\AuthController::class,'login']);
    Route::post('check',[\App\Http\Controllers\User\Auth\AuthController::class,'check']);

});

Route::middleware(['auth:users'])->group(function (){
    Route::prefix('profile')->group(function (){

        Route::get('',[\App\Http\Controllers\User\Profile\ProfileController::class,'me']);
        Route::post('',[\App\Http\Controllers\User\Profile\ProfileController::class,'update']);
        Route::post('image',[\App\Http\Controllers\User\Profile\ProfileController::class,'update_image']);

    });




});
