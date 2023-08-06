<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Management Routes
|--------------------------------------------------------------------------
|
| all management (admins) routes is here
|
*/

//Authenticate
Route::prefix('auth')->group(function (){
    Route::post('login',[\App\Http\Controllers\Manage\Auth\AuthController::class,'manage_login'])->name('auth.login');
});

//enable auth middleware for authenticate
Route::middleware('auth:admin')->group(function (){

    //authenticated user
    Route::prefix('me')->group(function (){
        Route::get('',[\App\Http\Controllers\Manage\Profile\ProfileController::class,'me'])->name('me');
    });

    //Members and Managers
    Route::group(['prefix' => 'users','as' => 'users.'],function (){
       Route::group(['prefix' => 'managers','as' => 'managers.'],function (){
           Route::get('',[\App\Http\Controllers\Manage\Users\UserController::class,'managers_index'])->name('index');
           Route::post('',[\App\Http\Controllers\Manage\Users\UserController::class,'managers_store'])->name('store');
           Route::post('{admin}',[\App\Http\Controllers\Manage\Users\UserController::class,'managers_update'])->name('update');
           Route::delete('{admin}',[\App\Http\Controllers\Manage\Users\UserController::class,'managers_delete'])->name('delete');
       });

       Route::group(['prefix' => 'members','as' => 'members.'],function (){
            Route::get('',[\App\Http\Controllers\Manage\Users\UserController::class,'members_index'])->name('index');
            Route::post('',[\App\Http\Controllers\Manage\Users\UserController::class,'members_store'])->name('store');
            Route::get('activation/{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_activation'])->name('activation');
            Route::post('{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_update'])->name('update');
            Route::delete('{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_delete'])->name('delete');
       });

    });

    //Faqs
    Route::group(['prefix' => 'faqs','as' => 'faqs.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Faqs\FaqsController::class,'index'])->name('index');
        Route::post('',[\App\Http\Controllers\Manage\Faqs\FaqsController::class,'store'])->name('store');
        Route::post('{faq}',[\App\Http\Controllers\Manage\Faqs\FaqsController::class,'update'])->name('update');
        Route::delete('{faq}',[\App\Http\Controllers\Manage\Faqs\FaqsController::class,'delete'])->name('delete');
    });

    //Brands
    Route::group(['prefix' => 'brands','as' => 'brands.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Brands\BrandController::class,'index'])->name('index');
        Route::post('',[\App\Http\Controllers\Manage\Brands\BrandController::class,'store'])->name('store');
        Route::post('{brand}',[\App\Http\Controllers\Manage\Brands\BrandController::class,'update'])->name('update');
        Route::delete('{brand}',[\App\Http\Controllers\Manage\Brands\BrandController::class,'delete'])->name('delete');
        Route::post('image/{brand}',[\App\Http\Controllers\Manage\Brands\BrandController::class,'update_image'])->name('update_image');
    });

    //Categories
    Route::group(['prefix' => 'categories','as' => 'categories.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Categories\CategoryController::class,'index'])->name('index');
        Route::post('',[\App\Http\Controllers\Manage\Categories\CategoryController::class,'store'])->name('store');
        Route::post('{category}',[\App\Http\Controllers\Manage\Categories\CategoryController::class,'update'])->name('update');
        Route::delete('{category}',[\App\Http\Controllers\Manage\Categories\CategoryController::class,'delete'])->name('delete');
        Route::post('image/{category}',[\App\Http\Controllers\Manage\Categories\CategoryController::class,'update_image'])->name('update_image');
    });

    Route::group(['prefix' => 'products','as' => 'products.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Products\ProductController::class,'index'])->name('index');
        Route::post('',[\App\Http\Controllers\Manage\Products\ProductController::class,'store'])->name('store');
        Route::post('{product}',[\App\Http\Controllers\Manage\Products\ProductController::class,'update'])->name('update');
        Route::delete('{product}',[\App\Http\Controllers\Manage\Products\ProductController::class,'delete'])->name('delete');
    });





});


