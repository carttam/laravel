<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::prefix('/')->group(function () {
    Route::post('', [ApiController::class, 'index']);
    Route::post('/isLogin', [ApiController::class, 'checkL'])->middleware('auth:api');
    Route::post('/logout', [ApiController::class, 'logout'])->middleware('auth:api');
    Route::post('/addComment', [ApiController::class, 'addComment'])->middleware('auth:api');
    Route::post('/addPost', [ApiController::class, 'addPost'])->middleware('auth:api');
    Route::post('/login', [ApiController::class, 'login']);
    Route::post('/signUp', [ApiController::class, 'signUp']);
});
