<?php

use App\Http\Controllers\DeviceController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::resources([
        'user'=>UserController::class,
        'device'=>DeviceController::class,
    ]);
});