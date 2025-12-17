<?php

// ==================== IMPORT KAMU (LENGKAP) + TAMBAH TIM ====================
use App\Http\Controllers\Admin\AdminPembayaranController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\Guru\TugasController;
use App\Http\Controllers\MateriPembelajaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TinyMceUploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaKelasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\GuruRegisterController;
use App\Http\Controllers\AdminGuruController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// TAMBAH DARI TIM (TIDAK BENTROK)
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JenjangController;


// ===================== AUTH & DASHBOARD BAWAAN (KAMU) =====================
Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// ===================== ADMIN (KAMU + TAMBAH FITUR TIM) =====================
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {

        // Dashboard admin
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        // User management
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/{id}', [UserController::class, 'show'])->name('show');
            Route::patch('/{id}/verifikasi', [UserController::class, 'verifikasi'])->name('verifikasi');
            Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
        });

        // Data Kelas
        Route::get('/data-kelas', [DataKelasController::class, 'index'])->name('data_kelas');
        Route::patch('/data-kelas/{id}/toggle', [DataKelasController::class, 'toggleStatus'])->name('data_kelas.toggle');

        // Laporan Admin
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
        Route::get('/laporan/export', [LaporanController::class, 'export'])->name('laporan.export');

        // ===================== PAYMENT =====================
        Route::get('/pembayaran', [AdminPembayaranController::class, 'index'])
            ->name('pembayaran.index');

        Route::post('/qris/update', [AdminPembayaranController::class, 'updateQris'])
            ->name('qris.update');

        Route::delete('/qris/delete', [AdminPembayaranController::class, 'deleteQris'])
            ->name('qris.delete');

        Route::post('/payments/{id}/verify', [AdminPembayaranController::class, 'verify'])
            ->name('payments.verify');
    });


// ===================== GURU (KAMU 100% - SUDAH LENGKAP) =====================
Route::prefix('guru')->name('guru.')->middleware(['auth','role:guru'])->group(function () {
    Route::get('/dashboard', [GuruController::class, 'index'])->name('dashboard');

    Route::prefix('kelas')->name('kelas.')->group(function () {
    Route::get('/', [GuruController::class, 'kelas'])->name('index');
    Route::get('/tambah', [GuruController::class, 'kelasCreate'])->name('create');
    Route::post('/', [GuruController::class, 'kelasStore'])->name('store');
    Route::get('/{id}', [GuruController::class, 'kelasDetail'])->name('show');
    Route::get('/{id}/edit', [GuruController::class, 'kelasEdit'])->name('edit');
    Route::put('/{id}', [GuruController::class, 'kelasUpdate'])->name('update');
    Route::delete('/{id}', [GuruController::class, 'kelasDestroy'])->name('destroy');
    Route::patch('/{id}/toggle-status', [GuruController::class, 'toggleStatusKelas'])->name('toggle-status');

        Route::post('/kelas/tambah-siswa', [\App\Http\Controllers\SiswaKelasController::class, 'tambahSiswaKeKelas'])->name('kelas.tambah-siswa');
        Route::delete('/kelas/{kelasId}/siswa/{siswaId}', [\App\Http\Controllers\SiswaKelasController::class, 'hapusSiswaDariKelas'])->name('kelas.hapus-siswa');
        Route::get('/kelas/{kelasId}/siswa', [\App\Http\Controllers\SiswaKelasController::class, 'daftarSiswaKelas'])->name('kelas.daftar-siswa');
    });

    Route::prefix('kelas/{kelasId}/materi')->name('materi_pembelajaran.')->group(function () {
        Route::get('/', [MateriPembelajaranController::class, 'index'])->name('index');
        Route::get('/create', [MateriPembelajaranController::class, 'create'])->name('create');
        Route::post('/', [MateriPembelajaranController::class, 'store'])->name('store');
        Route::get('/{materiId}', [MateriPembelajaranController::class, 'show'])->name('show');
        Route::get('/{materiId}/edit', [MateriPembelajaranController::class, 'edit'])->name('edit');
        Route::put('/{materiId}', [MateriPembelajaranController::class, 'update'])->name('update');
        Route::delete('/{materiId}', [MateriPembelajaranController::class, 'destroy'])->name('destroy');
    });
    Route::get('/pembayaran', [GuruController::class, 'pembayaran'])->name('pembayaran.index');  
    Route::get('/laporan-siswa', [GuruController::class, 'laporanSiswa'])->name('laporan_siswa.index');
    Route::get('/laporan-siswa', [GuruController::class, 'laporan'])->name('laporan_siswa.index');
    Route::get('/laporan-siswa/kelas/{kelasId}', [GuruController::class, 'laporanSiswaDaftarKelas'])->name('laporan_siswa.daftar');
    Route::get('/laporan-siswa/detail/{siswa_id}', [GuruController::class, 'laporanSiswaDetailSatuan'])->name('laporan_siswa.detail');

    Route::put('/laporan-siswa/catatan-umum/{siswa}', [GuruController::class, 'updateCatatanUmum'])->name('laporan_siswa.catatan_umum');

    Route::get('/laporan-siswa/pdf/{siswa_id}', [GuruController::class, 'exportLaporanSiswaPdfSimple'])->name('laporan_siswa.export_pdf');
    Route::get('/laporan-siswa/export-pdf/{kelas_id}/{siswa_id}', [GuruController::class, 'exportLaporanSiswaPdf'])->name('laporan_siswa.exportPdf');

    Route::get('/laporan-siswa/tambah/{siswa_id}', [GuruController::class, 'createLaporanSiswa'])->name('laporan_siswa.create');
    Route::post('/laporan-siswa/store', [GuruController::class, 'storeLaporanSiswa'])->name('laporan_siswa.store');
    Route::get('/laporan-siswa/edit/{laporan_id}', [GuruController::class, 'editLaporanSiswa'])->name('laporan_siswa.edit');
    Route::put('/laporan-siswa/update/{laporan_id}', [GuruController::class, 'updateLaporanSiswa'])->name('laporan_siswa.update');
    Route::delete('/laporan-siswa/hapus/{laporan_id}', [GuruController::class, 'destroyLaporanSiswa'])->name('laporan_siswa.destroy');
    // kuis dan tugas siswa
Route::prefix('kelas/{kelasId}/tugas')->name('tugas.')->group(function () {
    Route::get('/', [TugasController::class, 'index'])->name('index');
    Route::get('/create', [TugasController::class, 'create'])->name('create');
    Route::post('/', [TugasController::class, 'store'])->name('store');

    // kelola soal
    Route::get('/{tugas}/soal', [TugasController::class, 'editSoal'])->name('soal.edit');
    Route::post('/{tugas}/soal', [TugasController::class, 'storeSoal'])->name('soal.store');
}); // <-- PASTIKAN INI ADA

// route hapus tugas (DI LUAR grup di atas)
Route::delete('/kelas/{kelasId}/tugas/{tugas}', [TugasController::class, 'destroy'])
    ->name('tugas.destroy');

Route::post('/upload-image', [TinyMceUploadController::class, 'upload'])->name('upload.image');
Route::get('/siswa', [GuruController::class, 'siswa'])->name('siswa.index');
Route::get('/laporan', [GuruController::class, 'laporan'])->name('laporan.index');
Route::get('/transaksi', [GuruController::class, 'transaksi'])->name('transaksi.index');
Route::get('/profil', [GuruController::class, 'profil'])->name('profil.index');
Route::put('/profil', [GuruController::class, 'updateProfil'])->name('profil.update');
}); // <-- kurung tutup grup guru

// ===================== SISWA (KAMU 100% - SUDAH LENGKAP) =====================
Route::prefix('siswa')->name('siswa.')->middleware(['auth','role:siswa'])->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');

    Route::get('/kelas', [SiswaController::class, 'kelas'])->name('kelas.index');
    Route::get('/kelas/riwayat', [SiswaController::class, 'riwayatKelas'])->name('kelas.riwayat'); 
    Route::get('/kelas/{kelas}/materi/{materi?}', [SiswaKelasController::class, 'read'])->name('kelas.read'); 
    Route::post('/kelas/{kelas}/materi/{materi}/complete',[SiswaKelasController::class, 'markComplete'])->name('kelas.materi.complete');
    
    Route::get('/tugas', [SiswaController::class, 'tugas'])->name('tugas.index');

    Route::get('/pembayaran', [SiswaController::class, 'pembayaran'])->name('pembayaran.index');
    Route::post('/pembayaran', [SiswaController::class, 'storePembayaran'])->name('pembayaran.store');
    Route::get('/pembayaran/{pembayaran}', [SiswaController::class, 'showPembayaran'])->name('pembayaran.show');

    Route::get('/transaksi', [SiswaController::class, 'transaksi'])->name('transaksi.index');

    Route::get('/profil', [SiswaController::class, 'profil'])->name('profil.index');
    Route::put('/profil', [SiswaController::class, 'updateProfil'])->name('profil.update');
    Route::post('/catatan', [SiswaController::class, 'storeCatatan'])->name('catatan.store');
});
// Kuis & Ujian Routes
    Route::prefix('kuis')->name('kuis.')->group(function () {
        Route::get('/{tugas}', [App\Http\Controllers\Siswa\KuisController::class, 'show'])->name('show');
        Route::post('/{tugas}/start', [App\Http\Controllers\Siswa\KuisController::class, 'start'])->name('start');
        Route::get('/attempt/{attempt}', [App\Http\Controllers\Siswa\KuisController::class, 'attempt'])->name('attempt');
        Route::post('/attempt/{attempt}/submit', [App\Http\Controllers\Siswa\KuisController::class, 'submit'])->name('submit');
        Route::get('/result/{attempt}', [App\Http\Controllers\Siswa\KuisController::class, 'result'])->name('result');
        Route::get('/{tugas}/riwayat', [App\Http\Controllers\Siswa\KuisController::class, 'riwayat'])->name('riwayat');
    });

// ===================== TAMBAHAN DARI TIM (TIDAK BENTROK) =====================
Route::get('/beranda', [HomeController::class, 'index'])->name('home');

Route::get('/jenjang/sd', function () {
    return view('sd.index'); // resources/views/sd/index.blade.php
});

// route untuk halaman SMP (konsisten dengan route SD)
Route::get('/jenjang/smp', function () {
    return view('smp.index'); // resources/views/smp/index.blade.php
});

Route::get('/jenjang/sma', function () {
    return view('sma.index'); // resources/views/smp/index.blade.php
});

//Guru
Route::get('/guru/daftar', [GuruRegisterController::class, 'index'])->name('guru.index');
Route::post('/guru/daftar', [GuruRegisterController::class, 'store'])->name('guru.daftar');


// HALAMAN KONTAK (GET)
Route::get('/kontak', [ContactController::class, 'index'])
    ->name('kontak');

Route::post('/kontak/kirim', [ContactController::class, 'kirim'])
    ->name('kontak.kirim');


// Test route dari tim (opsional)
Route::get('/jenjang/test-route', function () {
    return 'OK ROUTE';
});


Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle'])
    ->name('auth.google.redirect');

Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])
    ->name('auth.google.callback');

Route::post('/logout', function (Request $request) {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::post('/admin/guru/{guru}/verifikasi', [AdminController::class, 'verifikasiGuru'])
    ->name('admin.guru.verifikasi');

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])
    ->name('admin.dashboard');
