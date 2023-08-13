<?php

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
    for ($i=1;$i<9;$i++){

        $cat = \App\Models\Implement_Category::create([
            'name' => "دسته بندی ".$i
        ]);
        for($j=1;$j<rand(4,13);$j++){
            $cat->implements()->create([
                'name' => 'ادوات شماره'.$j,
                'code' => rand(10000000,99999999),
                'price_type' => 'در هکتار'
            ]);
        }
    }


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


