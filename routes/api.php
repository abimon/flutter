<?php

use App\Http\Controllers\DustbinController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PickupController;
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
Route::controller(DustbinController::class)->prefix('/dustbin')->group(function () {
    Route::get('/index', 'index')->middleware('auth:sanctum');
    Route::get('/edit/{id}', 'edit');
    Route::post('/store', 'store')->middleware('auth:sanctum');
    Route::get('/show/{id}', 'show')->middleware('auth:sanctum');
    Route::post('/update', 'update');
    Route::delete('/delete/{id}', 'destroy')->middleware('auth:sanctum');
});
Route::controller(PickupController::class)->prefix('/pickup')->group(function () {
    Route::get('/', 'index');
    Route::post('/store', 'store');
    Route::get('/show/{id}', 'show');
 });
 Route::controller(PaymentController::class)->prefix('/payments')->group(function () {
    Route::post('/save', 'save');
    Route::get('/pay/{id}/{bin_id}', 'pay');
 });
