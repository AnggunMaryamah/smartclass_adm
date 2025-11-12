<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PaymentController;


Route::get('/', function () {
    return view('welcome');
});

// ========== Dashboard Admin ==========
Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->name('admin.dashboard');

// ========== User Management ==========
Route::get('/admin/users', [UserController::class, 'index'])
    ->name('admin.users');
Route::get('/admin/users/{id}', [UserController::class, 'show'])
    ->name('admin.users.show');
Route::patch('/admin/users/{id}/verifikasi', [UserController::class, 'verifikasi'])
    ->name('admin.users.verifikasi');

Route::prefix('admin')->group(function () {
    // Tambahkan baris ini ⬇️
    Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');

    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('admin.payments.show');
    Route::post('/payments/{id}/verify', [PaymentController::class, 'verify'])->name('admin.payments.verify');
});
