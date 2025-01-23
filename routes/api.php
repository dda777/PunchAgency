<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('password/email', [AuthController::class, 'sendResetLinkEmail']);
    Route::post('password/reset', [AuthController::class, 'resetPassword']);
})->withoutMiddleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::group(['prefix' => 'tasks'], function () {
        Route::get('/', [TaskController::class, 'index']);
        Route::post('/store', [TaskController::class, 'store']);
        Route::get('/{task}', [TaskController::class, 'show']);
        Route::put('/{task}', [TaskController::class, 'update']);
        Route::delete('/{task}', [TaskController::class, 'destroy']);
    });
});

