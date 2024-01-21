<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(UserController::class)->prefix('/user/')->group(function () {
    Route::get('show','show');
    Route::post('login','index');
    Route::post('create','create');
    Route::post('avatar/{id}','store');

});
Route::controller(VideoController::class)->group(function (){
    Route::post('upload/','create');
    Route::get('index','index');
});