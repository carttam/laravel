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
Route::prefix('admin')->group(function () {
    /*Get Request*/
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin');
    Route::get('/removeUser/{id}', [\App\Http\Controllers\AdminController::class, 'removeUser'])->name('removeUser');
    Route::get('/removeRole/{id}', [\App\Http\Controllers\AdminController::class, 'removeRole'])->name('removeRole');
    Route::get('/test', [\App\Http\Controllers\AdminController::class, 'test'])->name('test');
    Route::get('/getUserList/{id}', [\App\Http\Controllers\AdminController::class, 'getUserList'])->name('getUserList');
    Route::get('/getRoleList/{id}', [\App\Http\Controllers\AdminController::class, 'getRoleList'])->name('getRoleList');
    /*Post Request*/
    Route::post('/addUser', [\App\Http\Controllers\AdminController::class, 'insertUser'])->name('addUser');
    Route::post('/addRole', [\App\Http\Controllers\AdminController::class, 'insertRole'])->name('addRole');
    Route::post('/editUser', [\App\Http\Controllers\AdminController::class, 'editUser'])->name('editUser');
    Route::post('/editRole', [\App\Http\Controllers\AdminController::class, 'editRole'])->name('editRole');
});

Route::prefix('home')->group(function () {
    /*Get Request*/
    Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/ClearSession', [\App\Http\Controllers\HomeController::class, 'clearSession'])->name('clearSession');
    Route::get('/getComments/{post_id}', [\App\Http\Controllers\HomeController::class, 'getComments'])->name('getComments');
    /*Post Request*/
    Route::post('/addPost', [\App\Http\Controllers\HomeController::class, 'insertPost'])->name('addPost');
    Route::post('/addComment', [\App\Http\Controllers\HomeController::class, 'insertComment'])->name('addComment');
});
Route::get('/login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::post('/login', [\App\Http\Controllers\LoginController::class, 'logI'])->name('login');
Route::get('/signup', [\App\Http\Controllers\LoginController::class, 'signup'])->name('signup');
Route::post('/signup', [\App\Http\Controllers\LoginController::class, 'signU'])->name('signup');
