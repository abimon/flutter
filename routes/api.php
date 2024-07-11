<?php

use App\Http\Controllers\DeviceController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::resources([
        'device'=>DeviceController::class,
    ]);
});