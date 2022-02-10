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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//Route::group([middleware=>'auth:api' , namespace=> '\App\Http\Controllers\Api'], function () {
//    Route::get('/users' , [UserController::class , 'index']);
//
//});
/*
Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);*/


Route::middleware(['auth:api'])->group(function () {

    Route::get('users' , [\App\Http\Controllers\Api\UserController::class , 'index']);
    Route::post('logout' , [\App\Http\Controllers\Api\UserController::class , 'logout']);
    Route::post('users' , [\App\Http\Controllers\Api\UserController::class , 'update']);
    Route::post('changePassword' , [\App\Http\Controllers\Api\UserController::class , 'changePassword']);

    Route::post('post' , [\App\Http\Controllers\Api\PostController::class , 'store']);
    Route::post('share' , [\App\Http\Controllers\Api\PostController::class , 'share']);
    Route::get('post' , [\App\Http\Controllers\Api\PostController::class , 'index']);
    Route::delete('post/{id}/delete' , [\App\Http\Controllers\Api\PostController::class , 'destroy']);

    Route::get('home' , [\App\Http\Controllers\Api\PostController::class , 'timeLine']);
    Route::get('post/{id}' , [\App\Http\Controllers\Api\CommentController::class , 'index']);
    Route::post('comment' , [\App\Http\Controllers\Api\CommentController::class , 'store']);
    Route::delete('comment/{id}' , [\App\Http\Controllers\Api\CommentController::class , 'destroy']);


    Route::post('like' , [\App\Http\Controllers\Api\PostController::class , 'like']);

    Route::post('join' , [\App\Http\Controllers\Api\JoinController::class , 'store']);
    Route::delete('join' , [\App\Http\Controllers\Api\JoinController::class , 'destroy']);



});






Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);

Route::post('/password', [\App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail']);

Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::get('/getUser', [\App\Http\Controllers\Api\AuthController::class, 'getUser']);


});
