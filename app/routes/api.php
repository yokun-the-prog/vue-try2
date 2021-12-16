<?php

use App\Http\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/spot', [App\Http\Controllers\SpotController::class, 'read']);
Route::get('/tag', [App\Http\Controllers\TagController::class, 'read']);

Route::post('/tour/store', [App\Http\Controllers\TourController::class, 'guest_store']);
Route::post('/destination/store', [App\Http\Controllers\DestinationController::class, 'guest_store']);



// Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('api_logout');


// Route::post('/logout', function () {
//     return view('/');
// });


// Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

// Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
// App\Http\Controllers\Auth\LoginController@logout


//$this->post('logout', 'Auth\Http\Controllers\LoginController@logout')->name('logout');

//Route::get('/plan', 'App\Http\Controllers\SpotController@read');
