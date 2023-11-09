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
            Route::get('reserved',[\App\Http\Controllers\User\Plans\PlanController::class,'customer_reserved']);
            Route::get('check',[\App\Http\Controllers\User\Plans\PlanController::class,'customer_check']);
        });

        Route::prefix('provider')->group(function (){
            Route::get('buy/{plan}',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_buy']);
            Route::get('active',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_active']);
            Route::get('reserved',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_reserved']);
            Route::get('check',[\App\Http\Controllers\User\Plans\PlanController::class,'provider_check']);

        });

    });

    Route::prefix('gallery')->group(function (){

        Route::get('',[\App\Http\Controllers\User\Profile\GalleryController::class,'index']);
        Route::post('',[\App\Http\Controllers\User\Profile\GalleryController::class,'store']);
        Route::delete('/{id}',[\App\Http\Controllers\User\Profile\GalleryController::class,'delete']);

    });

    Route::prefix('lands')->group(function (){

        Route::get('',[\App\Http\Controllers\User\Lands\LandsController::class,'index']);
        Route::post('',[\App\Http\Controllers\User\Lands\LandsController::class,'store']);
        Route::delete('/{land}',[\App\Http\Controllers\User\Lands\LandsController::class,'delete']);

    });

    Route::prefix('provider')->group(function (){

        Route::get('range',[\App\Http\Controllers\User\Profile\ProfileController::class,'range']);
        Route::post('range',[\App\Http\Controllers\User\Profile\ProfileController::class,'range_update']);
        Route::get('days',[\App\Http\Controllers\User\Profile\ProfileController::class,'get_days']);
        Route::post('days',[\App\Http\Controllers\User\Profile\ProfileController::class,'store_days']);
        Route::delete('days/{day}',[\App\Http\Controllers\User\Profile\ProfileController::class,'delete_days']);

        Route::prefix('implement')->group(function (){
            Route::get('',[\App\Http\Controllers\User\Profile\ProfileController::class,'implement']);
            Route::post('',[\App\Http\Controllers\User\Profile\ProfileController::class,'implement_update']);
            Route::post('requests',[\App\Http\Controllers\User\Profile\ProfileController::class,'implement_request']);
            Route::delete('{id}',[\App\Http\Controllers\User\Profile\ProfileController::class,'implement_delete']);
            Route::post('edit/{id}',[\App\Http\Controllers\User\Profile\ProfileController::class,'implement_edit']);

        });

        Route::prefix('requests')->group(function (){
            Route::get('pending',[\App\Http\Controllers\User\Requests\RequestController::class,'pending']);
            Route::get('working',[\App\Http\Controllers\User\Requests\RequestController::class,'working']);
            Route::get('set-done/{request}',[\App\Http\Controllers\User\Requests\RequestController::class,'set_done']);
            Route::get('accept/{request}',[\App\Http\Controllers\User\Requests\RequestController::class,'accept']);
            Route::get('reject/{request}',[\App\Http\Controllers\User\Requests\RequestController::class,'reject']);

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

        //Requests
        Route::group(['middleware' => 'auth:users','prefix' => 'requests'],function (){

            Route::post('',[\App\Http\Controllers\Search\SearchingController::class,'search_providers_request_send']);
            Route::get('pending',[\App\Http\Controllers\Search\SearchingController::class,'search_providers_request_get_pending']);
            Route::get('working',[\App\Http\Controllers\Search\SearchingController::class,'search_providers_request_get_working']);
            Route::get('users/{request}',[\App\Http\Controllers\Search\SearchingController::class,'search_providers_request_users']);
            Route::delete('cancel/{request}',[\App\Http\Controllers\Search\SearchingController::class,'search_providers_request_cancel']);

        });


    });

});
