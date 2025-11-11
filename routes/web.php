<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
Route::patch('/admin/users/{id}/verifikasi', [UserController::class, 'verifikasi'])->name('admin.users.verifikasi');
Route::delete('/admin/users/{id}', [UserController::class, 'destroy'])->name('admin.users.destroy');

// GURU
Route::prefix('guru')->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('guru.dashboard');
    Route::get('/kelas', [GuruController::class, 'kelas'])->name('guru.kelas');
    Route::get('/siswa', [GuruController::class, 'siswa'])->name('guru.siswa');
    Route::get('/laporan', [GuruController::class, 'laporan'])->name('guru.laporan');
    Route::get('/pembayaran', [GuruController::class, 'pembayaran'])->name('guru.pembayaran');
    Route::get('/transaksi', [GuruController::class, 'transaksi'])->name('guru.transaksi');
    Route::get('/profil', [GuruController::class, 'profil'])->name('guru.profil');
});

// SISWA
Route::get('/siswa/dashboard', [SiswaController::class, 'index'])->name('siswa.dashboard');