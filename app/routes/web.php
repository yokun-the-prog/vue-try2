<?php

use App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// 管理者用
Route::group(['prefix' => 'admin', 'middleware' => 'admin'],function(){
    // 管理画面表示
    Route::get('/', [App\Http\Controllers\HomeController::class, 'admin_index'])->name('admin.index');
    // 管理項目表示
    Route::resource('/users', App\Http\Controllers\UserController::class);
    Route::resource('/spots', App\Http\Controllers\SpotController::class);
    Route::resource('/tours', App\Http\Controllers\TourController::class);
    Route::resource('/destinations', App\Http\Controllers\DestinationController::class);
    Route::resource('/photorallyDivisions', App\Http\Controllers\PhotorallyDivisionController::class);
    Route::resource('/transportDivisions', App\Http\Controllers\TransportDivisionController::class);
    Route::resource('/erratumDivisions', App\Http\Controllers\ErratumDivisionController::class);
    Route::resource('/tags', App\Http\Controllers\TagController::class);
    Route::resource('/spotTags', App\Http\Controllers\SpotTagController::class);
    Route::resource('/spotFilepaths', App\Http\Controllers\SpotFilepathController::class);
    Route::resource('/tourFilepaths', App\Http\Controllers\TourFilepathController::class);
});

// Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout', 'logout');


// 利用画面
//Route::group(['prefix' => 'guest', 'middleware' => 'auth'],function(){
Route::group(['middleware' => 'auth'],function(){
        // メニュー画面表示

    Route::get('guest', [App\Http\Controllers\HomeController::class, 'guest_index'])->name('guest.index');


});


