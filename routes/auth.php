<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::middleware('guest')->group(function () {
    Route::get('/admin/login', [AuthController::class, 'showAdminLoginForm'])
        ->name('admin.login');

    Route::post('/admin/login', [AuthController::class, 'adminLogin']);

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);

    // Forgot Password
    Route::get('/forgot-password', [AuthController::class, 'showForgotForm'])
        ->name('password.request');

    Route::post('/forgot-password', [AuthController::class, 'sendResetLink'])
        ->name('password.email');

    // Reset Password
    Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('/reset-password', [AuthController::class, 'resetPassword'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Confirm Password
    Route::get('/confirm-password', [AuthController::class, 'showConfirmForm'])
        ->name('password.confirm');

    Route::post('/confirm-password', [AuthController::class, 'confirmPassword']);
});
