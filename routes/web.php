<?php

use Illuminate\Support\Facades\Route;

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
    return redirect('/home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\ProductController::class, 'home'])->name('home');
Route::get('/product/{id}', [App\Http\Controllers\ProductController::class, 'detail']);
Route::get('/search/product', [App\Http\Controllers\ProductController::class, 'search']);
Route::post('/search/product', [App\Http\Controllers\ProductController::class, 'search']);

Route::group(['prefix' => '/user', 'middleware' => ['validateUser', 'auth']], function (){
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update']);

    Route::post('/cart/add/{id}', [App\Http\Controllers\CartController::class, 'add']);
    Route::get('/cart', [App\Http\Controllers\CartController::class, 'view']);
    Route::delete('/cart/delete/{id}', [App\Http\Controllers\CartController::class, 'delete']);

    Route::post('/checkout', [App\Http\Controllers\TransactionController::class, 'checkout']);
});

Route::group(['prefix' => '/admin', 'middleware' => ['validateAdmin', 'auth']], function (){
    Route::prefix('/product')->group(function(){
        Route::get('/insert', [App\Http\Controllers\ProductController::class, 'index']);
        Route::post('/insert', [App\Http\Controllers\ProductController::class, 'insert']);
        Route::get('/edit/{id}', [App\Http\Controllers\ProductController::class, 'edit']);
        Route::put('/update/{id}', [App\Http\Controllers\ProductController::class, 'update']);
    });

    Route::get('/users', [App\Http\Controllers\ProfileController::class, 'view']);
    Route::delete('/user/{id}', [App\Http\Controllers\ProfileController::class, 'delete']);
});

