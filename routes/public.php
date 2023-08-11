<?php
use Illuminate\Support\Facades\Route;


Route::prefix('news')->group(function (){

    Route::get('',[\App\Http\Controllers\Public\NewsController::class,'index']);
    Route::get('latest',[\App\Http\Controllers\Public\NewsController::class,'latest']);

});
