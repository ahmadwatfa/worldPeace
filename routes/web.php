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


Route::get('/index' , [\App\Http\Controllers\CustomerRepositoryController::class , 'index']);
Route::get('/user/{id}' , [\App\Http\Controllers\CustomerRepositoryController::class , 'getUser']);
Route::get('/delete/{id}' , [\App\Http\Controllers\CustomerRepositoryController::class , 'deleteUser']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
