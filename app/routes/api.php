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
Route::get('/spotTag', [App\Http\Controllers\SpotTagController::class, 'read']);
Route::get('/tour', [App\Http\Controllers\TourController::class, 'read']);

Route::post('/tour/store', [App\Http\Controllers\TourController::class, 'guest_store']);
Route::post('/destination/store', [App\Http\Controllers\DestinationController::class, 'guest_store']);

