<?php

use App\Http\Controllers\Api\profileController;
use App\Http\Controllers\Api\UserController;
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
// Authentications routes
Route::prefix('user')->group(function(){
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    // Route::put('/updatePassword', [profileController::class, 'showAllUsers']);
});

Route::get('/getusers', [profileController::class, 'showAllUsers']);

Route::middleware('auth:sanctum')->group(function () {
    // return $request->user();
    Route::prefix('user')->group(function(){
        Route::post('/register', [UserController::class, 'register']);
        Route::post('/login', [UserController::class, 'login']);
        Route::put('/updatePassword', [profileController::class, 'showAllUsers']);
    });
    Route::prefix('division')->group(function(){
        Route::post('/new', [UserController::class, 'register']);
        Route::de('/updatePassword', [profileController::class, 'showAllUsers']);
        Route::post('/update', [UserController::class, 'login']);
    });
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/getuser', [profileController::class, 'logout']);
});
// test route


