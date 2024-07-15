<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)->prefix('/user')->group(function () {
    Route::get('/index', 'index');
    Route::post('/login', 'create');
    Route::post('/register', 'store');
    Route::get('/show/{id}', 'show')->middleware('auth:sanctum');
    Route::get('/get', 'getUser')->middleware('auth:sanctum');
    Route::put('/update/{id}', 'update')->middleware('auth:sanctum');
    Route::delete('/delete/{id}', 'destroy')->middleware('auth:sanctum');
});
Route::controller(DeviceController::class)->prefix('/device')->group(function () {
    Route::get('/index', 'index')->middleware('auth:sanctum');
    Route::get('/edit/{id}', 'edit');
    Route::get('/get/{id}', 'getDevice');
    Route::post('/store', 'store')->middleware('auth:sanctum');
    Route::get('/show/{id}', 'show')->middleware('auth:sanctum');
    Route::put('/update/{id}', 'update')->middleware('auth:sanctum');
    Route::delete('/delete/{id}', 'destroy')->middleware('auth:sanctum');
});
