<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PembayaranController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard Admin
Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

// User Management (hanya lihat dan verifikasi)
Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users');
Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
Route::patch('/admin/users/{id}/verifikasi', [UserController::class, 'verifikasi'])->name('admin.users.verifikasi');

Route::get('/admin/data-kelas', [DataKelasController::class, 'index'])->name('admin.data_kelas');
Route::get('/admin/data-kelas', [DataKelasController::class, 'index'])->name('admin.data_kelas');
Route::patch('/admin/data-kelas/{id}/toggle', [DataKelasController::class, 'toggleStatus'])->name('admin.data_kelas.toggle');

Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
Route::get('/admin/laporan/export', [LaporanController::class, 'export'])->name('admin.laporan.export');
# pembayaran manajemen
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayarans.index');
    Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('pembayarans.store');
    Route::get('/pembayaran/{id}', [PembayaranController::class, 'show'])->name('pembayarans.show');
    Route::delete('/pembayaran/{id}', [PembayaranController::class, 'destroy'])->name('pembayarans.destroy');
});
