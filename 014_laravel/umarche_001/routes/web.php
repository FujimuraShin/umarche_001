<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OwnersController;
use App\Http\Controllers\Admin\ShopController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::resource('owners',OwnersController::class);

Route::post('owners/store',[OwnersContoller::class,'index']);

Route::post('owners/update',[OwnersContoller::class,'update']);

Route::prefix('expired-owners')-> 
    group(function(){

        Route::get('index',[OwnersController::class,'expiredOwnerIndex'])->name('expired-owners.index');

        Route::post('destroy/{owner}',[OwnersController::class,'expiredOwnerDestroy'])->name('expired-owners.destroy');
    });

    /*
Route::prefix('shop')-> 
    group(function(){

        Route::get('index',[ShopController::class,'index'])->name('shops.index');

        Route::get('destroy/{shop}',[ShopController::class,'edit'])->name('shops.edit');

        Route::post('update/{shop}',[ShopController::class,'update'])->name('shops.update');
    });
    */

    Route::get('shops/index',[ShopController::class,'index'])->name('shops.index');

    Route::get('shops/edit/{shop}',[ShopController::class,'edit'])->name('shops.edit');

    Route::post('shops/update/{shop}',[ShopController::class,'update'])->name('shops.update');

require __DIR__.'/auth.php';
