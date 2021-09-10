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
Route::prefix('admin')->group(function (){
    /*Get Request*/
   Route::get('/',[\App\Http\Controllers\AdminController::class,'index'])->name('admin');
   /*Post Request*/
    Route::post('addUser',[\App\Http\Controllers\AdminController::class,'insertUser'])->name('addUser');
    Route::post('addRole',[\App\Http\Controllers\AdminController::class,'insertRole'])->name('addRole');
    Route::post('addPost',[\App\Http\Controllers\AdminController::class,'insertPost'])->name('addPost');
});
