<?php

use App\Http\Controllers\APIContoller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [APIContoller::class,'index']);
Auth::routes();
Route::get('/chalk', function(){ return view('chalk');});
Route::get('/treasure', function(){ return view('treasure');});
