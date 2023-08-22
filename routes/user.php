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

    Route::prefix('callbacks')->group(function (){
        Route::prefix('plans/payments')->group(function (){
            Route::get('customer',[\App\Http\Controllers\User\Plans\PlanController::class,'customer_by_verify'])->withoutMiddleware('auth:users');
            Route::get('provider',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_by_verify'])->withoutMiddleware('auth:users');

        });

    });

    //Search provider
    Route::prefix('search')->group(function (){
        Route::post('providers',[\App\Http\Controllers\Search\SearchingController::class,'search_providers']);
        Route::get('providers/profile/{user}',[\App\Http\Controllers\Search\SearchingController::class,'provider_profile']);
        Route::get('providers/gallery/{user}',[\App\Http\Controllers\Search\SearchingController::class,'provider_gallery']);
    });

});
