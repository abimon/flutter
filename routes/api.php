<?php

use App\Http\Controllers\APIContoller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(APIContoller::class)->group(function () {
        Route::get('');
    });
});