<?php

use App\Http\Controllers\APIContoller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [APIContoller::class,'index']);
Auth::routes();
Route::get('/chalk', function () {
    return view('chalk');
});
Route::get('/treasure', function () {
    return view('treasure');
});
Route::get('/masterguide', function () {
    return view('masterguide');
});
