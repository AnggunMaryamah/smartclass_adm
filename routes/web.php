<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

    // Homepage
Route::get('/', function () {
    return view('welcome');
});


    // ADMIN ROUTES

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // User Management
    Route::get('/users', [UserController::class, 'index'])->name('admin.users');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::patch('/users/{id}/verifikasi', [UserController::class, 'verifikasi'])->name('admin.users.verifikasi');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');
    // Payments
    Route::get('/payments', [PaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/payments/{id}', [PaymentController::class, 'show'])->name('admin.payments.show');
    Route::post('/payments/{id}/verify', [PaymentController::class, 'verify'])->name('admin.payments.verify');
});
    // GURU ROUTES
Route::prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/kelas', [GuruController::class, 'kelas'])->name('guru.kelas');
    Route::get('/siswa', [GuruController::class, 'siswa'])->name('guru.siswa');
    Route::get('/laporan', [GuruController::class, 'laporan'])->name('guru.laporan');
    Route::get('/pembayaran', [GuruController::class, 'pembayaran'])->name('guru.pembayaran');
    Route::get('/transaksi', [GuruController::class, 'transaksi'])->name('guru.transaksi');
    Route::get('/profil', [GuruController::class, 'profil'])->name('guru.profil');
});
    // SISWA ROUTES
Route::prefix('siswa')->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');
});
Route::get('/kelas', [SiswaController::class, 'kelas'])->name('siswa.kelas');
Route::get('/pembayaran', [SiswaController::class, 'pembayaran'])->name('siswa.pembayaran');
Route::get('/transaksi', [SiswaController::class, 'transaksi'])->name('siswa.transaksi');
Route::get('/profil', [SiswaController::class, 'profil'])->name('siswa.profil');