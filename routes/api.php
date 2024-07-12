<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix('/user')->group(function () {
    Route::get('/login', 'create');
    Route::post('/register', 'store');
    Route::get('/show/{id}','show');
    Route::put('/update/{id}', 'update');
    Route::delete('/delete/{id}', 'destroy');
});
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(DeviceController::class)->prefix('/device')->group(function () {
        Route::get('/index', 'index');
        Route::post('/store', 'store');
        Route::get('/show/{id}','show');
        Route::put('/update/{id}', 'update');
        Route::delete('/delete/{id}', 'destroy');
    });
});