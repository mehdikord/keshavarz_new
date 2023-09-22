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

    //Dashboard
    Route::group(['prefix' => 'dashboard','as'=>'dashboard.'],function (){
        Route::get('main/info',[\App\Http\Controllers\Manage\Dashboard\DashboardController::class,'main_info'])->name('main_info');
        Route::get('last/invoices',[\App\Http\Controllers\Manage\Dashboard\DashboardController::class,'last_invoices'])->name('last_invoices');
        Route::get('last/users',[\App\Http\Controllers\Manage\Dashboard\DashboardController::class,'last_users'])->name('last_users');
        Route::get('payments',[\App\Http\Controllers\Manage\Dashboard\DashboardController::class,'payments'])->name('payments');
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
           Route::get('{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_show'])->name('show');
           Route::get('invoices/{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_invoices']);
           Route::post('invoices/{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_invoices_create']);
           Route::get('active/provider/{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_active_provider']);
           Route::get('active/customer/{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_active_customer']);

           Route::get('activation/{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_activation'])->name('activation');
            Route::post('{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_update'])->name('update');
            Route::delete('{user}',[\App\Http\Controllers\Manage\Users\UserController::class,'members_delete'])->name('delete');
       });

    });

    //Implements
    Route::group(['prefix' => 'implements','as'=>'implements.'],function (){

        //requests
        Route::group(['prefix' => 'requests','as' => 'requests.'],function (){
            Route::get('',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'requests_index'])->name('index');
            Route::delete('{request}',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'requests_delete'])->name('delete');
        });

        //Categories
        Route::group(['prefix' => 'categories','as' => 'categories.'],function (){
            Route::get('',[\App\Http\Controllers\Manage\Implements\CategoryController::class,'index'])->name('index');
            Route::post('',[\App\Http\Controllers\Manage\Implements\CategoryController::class,'store'])->name('store');
            Route::post('{category}',[\App\Http\Controllers\Manage\Implements\CategoryController::class,'update'])->name('update');
            Route::delete('{category}',[\App\Http\Controllers\Manage\Implements\CategoryController::class,'delete'])->name('delete');
            Route::post('image/{category}',[\App\Http\Controllers\Manage\Implements\CategoryController::class,'update_image'])->name('update_image');
        });

        //Forms
        Route::group(['prefix' => 'forms','as' => 'forms.'],function (){
            Route::get('',[\App\Http\Controllers\Manage\Implements\FormController::class,'index'])->name('index');
            Route::post('',[\App\Http\Controllers\Manage\Implements\FormController::class,'store'])->name('store');
            Route::post('{form}',[\App\Http\Controllers\Manage\Implements\FormController::class,'update'])->name('update');
            Route::delete('{form}',[\App\Http\Controllers\Manage\Implements\FormController::class,'delete'])->name('delete');
        });

        Route::get('',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'index'])->name('index');
        Route::post('',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'store'])->name('store');
        Route::post('{implement}',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'update'])->name('update');
        Route::delete('{implement}',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'delete'])->name('delete');
        Route::post('image/{implement}',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'update_image'])->name('update_image');
        Route::post('form/{implement}',[\App\Http\Controllers\Manage\Implements\ImplementController::class,'forms'])->name('forms');

    });

    //Plans
    Route::group(['prefix' => 'plans','as'=>'plans.'],function (){

        Route::group(['prefix' => 'providers','as'=>'providers.'],function (){

            Route::get('',[\App\Http\Controllers\Manage\Plans\PlanController::class,'provider_index'])->name('index');
            Route::post('',[\App\Http\Controllers\Manage\Plans\PlanController::class,'provider_store'])->name('store');
            Route::post('{plan}',[\App\Http\Controllers\Manage\Plans\PlanController::class,'provider_update'])->name('update');
            Route::delete('{plan}',[\App\Http\Controllers\Manage\Plans\PlanController::class,'provider_delete'])->name('delete');
            Route::post('image/{plan}',[\App\Http\Controllers\Manage\Plans\PlanController::class,'provider_update_image'])->name('update_image');
            Route::get('activation/{plan}',[\App\Http\Controllers\Manage\Plans\PlanController::class,'provider_activation'])->name('activation');

        });

        Route::group(['prefix' => 'customers','as'=>'customers.'],function (){

            Route::get('',[\App\Http\Controllers\Manage\Plans\PlanController::class,'customer_index'])->name('index');
            Route::post('',[\App\Http\Controllers\Manage\Plans\PlanController::class,'customer_store'])->name('store');
            Route::post('{plan}',[\App\Http\Controllers\Manage\Plans\PlanController::class,'customer_update'])->name('update');
            Route::delete('{plan}',[\App\Http\Controllers\Manage\Plans\PlanController::class,'customer_delete'])->name('delete');
            Route::post('image/{plan}',[\App\Http\Controllers\Manage\Plans\PlanController::class,'customer_update_image'])->name('update_image');
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

    Route::group(['prefix' => 'slider','as' => 'slider.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Slider\SliderController::class,'index'])->name('index');
        Route::post('',[\App\Http\Controllers\Manage\Slider\SliderController::class,'store'])->name('store');
        Route::post('{slider}',[\App\Http\Controllers\Manage\Slider\SliderController::class,'update'])->name('update');
        Route::delete('{slider}',[\App\Http\Controllers\Manage\Slider\SliderController::class,'delete'])->name('delete');
        Route::post('image/{slider}',[\App\Http\Controllers\Manage\Slider\SliderController::class,'update_image'])->name('update_image');
    });


    Route::group(['prefix' => 'news','as' => 'news.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\News\NewsController::class,'index'])->name('index');
        Route::post('',[\App\Http\Controllers\Manage\News\NewsController::class,'store'])->name('store');
        Route::post('{news}',[\App\Http\Controllers\Manage\News\NewsController::class,'update'])->name('update');
        Route::delete('{news}',[\App\Http\Controllers\Manage\News\NewsController::class,'delete'])->name('delete');
        Route::post('image/{news}',[\App\Http\Controllers\Manage\News\NewsController::class,'update_image'])->name('update_image');
    });

    Route::group(['prefix' => 'contacts','as' => 'contacts.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Contacts\ContactController::class,'index'])->name('index');
        Route::delete('{contact}',[\App\Http\Controllers\Manage\Contacts\ContactController::class,'delete'])->name('delete');
    });

    //Searches
    Route::group(['prefix' => 'searches','as' => 'searches.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Searches\SearchController::class,'index'])->name('index');
        Route::delete('{search}',[\App\Http\Controllers\Manage\Searches\SearchController::class,'delete'])->name('delete');
    });

    //Searches
    Route::group(['prefix' => 'invoices','as' => 'invoices.'],function (){
        Route::get('',[\App\Http\Controllers\Manage\Invoices\InvoiceController::class,'index'])->name('index');
        Route::get('change/pay/{invoice}',[\App\Http\Controllers\Manage\Invoices\InvoiceController::class,'change_pay'])->name('change_pay');
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
        Route::get('activation/{product}',[\App\Http\Controllers\Manage\Products\ProductController::class,'activation'])->name('activation');
        Route::post('',[\App\Http\Controllers\Manage\Products\ProductController::class,'store'])->name('store');
        Route::post('{product}',[\App\Http\Controllers\Manage\Products\ProductController::class,'update'])->name('update');
        Route::delete('{product}',[\App\Http\Controllers\Manage\Products\ProductController::class,'delete'])->name('delete');
        Route::group(['prefix' => '{product}/images','as' => 'images'],function (){
            Route::get('',[\App\Http\Controllers\Manage\Products\ProductController::class,'images_index'])->name('index');
            Route::post('',[\App\Http\Controllers\Manage\Products\ProductController::class,'images_store'])->name('store');



        });
    });



    Route::prefix('helpers')->group(function (){
        Route::get('provinces',[\App\Http\Controllers\Manage\Helper\HelperController::class,'provinces']);

    });





});


