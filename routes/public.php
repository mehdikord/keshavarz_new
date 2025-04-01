<?php
use Illuminate\Support\Facades\Route;



Route::prefix('news')->group(function (){

    Route::get('',[\App\Http\Controllers\Public\NewsController::class,'index']);
    Route::get('latest',[\App\Http\Controllers\Public\NewsController::class,'latest']);

});


Route::prefix('implements')->group(function (){
    Route::get('categories',[\App\Http\Controllers\Public\ImplementController::class,'categories']);
    Route::get('specials',[\App\Http\Controllers\Public\ImplementController::class,'implements_specials']);
    Route::get('implements',[\App\Http\Controllers\Public\ImplementController::class,'implements']);
    Route::get('implements/{implement}',[\App\Http\Controllers\Public\ImplementController::class,'implements_show']);

});

Route::get('provinces',[\App\Http\Controllers\Public\PublicController::class,'provinces']);
Route::get('cities',[\App\Http\Controllers\Public\PublicController::class,'cities']);
Route::get('slider',[\App\Http\Controllers\Public\PublicController::class,'slider']);

Route::prefix('plans')->group(function (){

    Route::get('customer',[\App\Http\Controllers\Public\PublicController::class,'plans_customer']);
    Route::get('provider',[\App\Http\Controllers\Public\PublicController::class,'plans_provider']);


});

Route::prefix('contacts')->group(function (){

    Route::post('message',[\App\Http\Controllers\Public\ContactController::class,'send_message']);

});

Route::prefix('faqs')->group(function (){

    Route::get('',[\App\Http\Controllers\Public\PublicController::class,'faqs']);
});

Route::prefix('weathers')->group(function (){
   Route::post('current',[\App\Http\Controllers\Public\WeatherController::class,'current']);
   Route::post('exclude',[\App\Http\Controllers\Public\WeatherController::class,'exclude']);


});
