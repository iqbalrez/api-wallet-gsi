<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserPocketController;

Route::prefix('auth')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/profile', [AuthController::class, 'profile'])->middleware('auth:api')->name('profile');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/pockets', [UserPocketController::class, 'create'])->name('pockets.create');
});