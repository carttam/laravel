<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('',[\App\Http\Controllers\ApiController::class,'index'])->name('api.index');
Route::post('/isLogin',[\App\Http\Controllers\ApiController::class,'checkL'])->middleware('auth:api')->name('api.isLogin');
Route::post('/logout',[\App\Http\Controllers\ApiController::class,'logout'])->middleware('auth:api')->name('api.logout');
Route::post('/addComment',[\App\Http\Controllers\ApiController::class,'addComment'])->middleware('auth:api')->name('api.addComment');
Route::post('/login',[\App\Http\Controllers\ApiController::class,'login'])->name('api.login');
Route::post('/signUp',[\App\Http\Controllers\ApiController::class,'signUp'])->name('api.signUp');

