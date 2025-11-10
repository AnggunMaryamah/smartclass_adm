<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// User Management (hanya lihat dan verifikasi)
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
Route::patch('/admin/users/{id}/verifikasi', [UserController::class, 'verifikasi'])->name('admin.users.verifikasi');