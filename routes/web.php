<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('photos', PhotoController::class);

Route::resource('albums', AlbumController::class);

// Routes Authentication
Route::get('/create', [AuthController::class, 'create'])->name('auth.create');
Route::post('/store', [AuthController::class, 'store'])->name('auth.store');
Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/verif', [AuthController::class, 'verifLogin'])->name('auth.verifLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
