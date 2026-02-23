<?php

use App\Http\Controllers\APIContoller;
use App\Http\Controllers\ContributionController;
use App\Http\Controllers\WeddingController;
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

// Wedding Routes
Route::prefix('wedding')->group(function () {
    Route::get('/', [WeddingController::class, 'index'])->name('wedding.index');
    Route::get('/upload', [WeddingController::class, 'uploadForm'])->name('wedding.upload-form');
    Route::post('/upload', [WeddingController::class, 'upload'])->name('wedding.upload');
    Route::get('/progress', [WeddingController::class, 'getProgress'])->name('wedding.progress');

    // call center access – phone lookup form and results
    Route::match(['get','post'], '/call-center', [WeddingController::class, 'callCenter'])
        ->name('wedding.call-center');
});
Route::middleware('auth')->group(function () {
    Route::resources([
        'contributions' => ContributionController::class,
    ]);
});
