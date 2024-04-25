<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordForgotController;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);

    Route::get('login', [LoginController::class, 'create'])->name('login');
    Route::post('login', [LoginController::class, 'store']);

    Route::get('forgot-password', [PasswordForgotController::class, 'create'])
        ->name('password.request');
    Route::post('forgot-password', [PasswordForgotController::class, 'store'])
        ->name('password.email');
    Route::get('reset-password/{token}', [PasswordResetController::class, 'create'])
        ->name('password.reset');
    Route::post('reset-password', [PasswordResetController::class, 'store'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('logout', [LoginController::class, 'destroy'])->name('logout');
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');
});
