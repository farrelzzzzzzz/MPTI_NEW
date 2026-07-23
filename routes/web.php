<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/tentang', function () {
    return view('pages.about');
})->name('about');

Route::get('/testimoni', function () {
    return view('pages.testimoni');
})->name('testimoni');

Route::get('/kontak', function () {
    return view('pages.kontak');
})->name('kontak');

Route::get('/order', [OrderController::class, 'index'])
    ->name('order');

Route::post('/order/store', [OrderController::class, 'store'])
    ->name('order.store');

Route::get(
    '/order/confirm/{id}',
    [OrderController::class, 'confirm']
)
    ->name('order.confirm');

Route::get(
    '/order/cancel/{id}',
    [OrderController::class, 'cancel']
)
    ->name('order.cancel');

Route::get(
    '/order/send/{id}',
    [OrderController::class, 'sendWa']
)
    ->name('order.send');

// ============================================================
// ADMIN ROUTES
// ============================================================
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/orders', [AdminController::class, 'orders'])
        ->name('admin.orders');

    Route::get('/orders/export', [AdminController::class, 'exportOrders'])
        ->name('admin.orders.export');

    Route::patch('/orders/batch', [AdminController::class, 'batchUpdateOrders'])
        ->name('admin.orders.batch');

    Route::get('/orders/{order}', [AdminController::class, 'orderDetail'])
        ->name('admin.orders.show');

    Route::patch('/orders/{order}/status', [AdminController::class, 'updateOrderStatus'])
        ->name('admin.orders.status');

    Route::get('/users', [AdminController::class, 'users'])
        ->name('admin.users');

    Route::patch('/users/{user}/role', [AdminController::class, 'updateUserRole'])
        ->name('admin.users.role');
});

// ============================================================
// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('google.login');

Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
    ->name('google.callback');

require __DIR__ . '/auth.php';

Route::post('/chatbot', [ChatbotController::class, 'chat']);

Route::view('/test-chat', 'test-chat');
