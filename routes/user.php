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

    Route::prefix('plans')->group(function (){

        Route::prefix('customer')->group(function (){
            Route::get('buy/{plan}',[\App\Http\Controllers\User\Plans\PlanController::class,'customer_buy']);
            Route::get('active',[\App\Http\Controllers\User\Plans\PlanController::class,'customer_active']);
            Route::get('all',[\App\Http\Controllers\User\Plans\PlanController::class,'customer_all']);
        });

        Route::prefix('provider')->group(function (){
            Route::get('buy/{plan}',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_buy']);
            Route::get('active',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_active']);
            Route::get('all',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_all']);

        });

    });



});
