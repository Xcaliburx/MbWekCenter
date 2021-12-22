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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/user', 'middleware' => ['validateUser', 'auth']], function (){
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update']);
});

