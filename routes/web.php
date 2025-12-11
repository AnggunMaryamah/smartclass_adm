<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\MateriPembelajaranController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TinyMceUploadController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaKelasController;
use App\Http\Controllers\Auth\SiswaAuthController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\Auth\GeneralLoginController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\KelasController;

/*
|--------------------------------------------------------------------------
| Web Routes (final, rapi)
|--------------------------------------------------------------------------
|
| Menjaga semua route dan nama route yang sudah ada — hanya merapikan
| serta memastikan tidak ada duplikasi / route yang hilang.
|
*/

/* ------------------ Public / Auth ------------------ */

// Halaman welcome (opsional)
Route::get('/', function () {
    return view('welcome');
});

// Profile (bawaan, but auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Include auth scaffolding (login/register/etc)
require __DIR__ . '/auth.php';

// General login (custom)
Route::get('/login', [GeneralLoginController::class, 'showLogin'])->name('login');
Route::post('/login', [GeneralLoginController::class, 'login'])->name('login.submit');
Route::post('/logout', [GeneralLoginController::class, 'logout'])->name('logout');

// Google OAuth
Route::get('/auth/google/redirect', [SocialAuthController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback'])->name('google.callback');

// Register pending info
Route::get('/register/pending', function () {
    return view('auth.register-pending');
})->name('register.pending');

/* ------------------ Admin ------------------ */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

    // Users management (named admin.users)
    // kept as single route for listing (other user routes already exist under users.* inside admin)
    Route::get('/users', [AdminUserController::class, 'index'])->name('users');

    // More user actions (show/verifikasi/destroy) under admin.users.* as nested routes
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::patch('/{id}/verifikasi', [UserController::class, 'verifikasi'])->name('verifikasi');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // Payments
    Route::prefix('payments')->name('payments.')->group(function () {
        Route::get('/', [PaymentController::class, 'index'])->name('index');
        Route::get('/{id}', [PaymentController::class, 'show'])->name('show');
        Route::post('/{id}/verify', [PaymentController::class, 'verify'])->name('verify');
    });
});

/* ------------------ Guru ------------------ */
/*
  Single guru group: semua route guru berada di bawah prefix 'guru'
  Dengan middleware: auth, role:guru, check.active (so guru pending tidak bisa akses)
*/
Route::prefix('guru')->name('guru.')->middleware(['auth', 'role:guru', 'check.active'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [GuruController::class, 'dashboard'])->name('dashboard');

    // Kelas CRUD & related actions
    Route::prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', [GuruController::class, 'indexKelas'])->name('index');
        Route::get('/tambah', [GuruController::class, 'createKelas'])->name('create');
        Route::post('/', [GuruController::class, 'storeKelas'])->name('store');
        Route::get('/{id}', [GuruController::class, 'showKelas'])->name('show');
        Route::get('/{id}/edit', [GuruController::class, 'editKelas'])->name('edit');
        Route::put('/{id}', [GuruController::class, 'updateKelas'])->name('update');
        Route::delete('/{id}', [GuruController::class, 'destroyKelas'])->name('destroy');
        Route::patch('/{id}/toggle-status', [GuruController::class, 'toggleStatusKelas'])->name('toggle-status');

        // siswa in class management (controller SiswaKelasController)
        Route::post('/kelas/tambah-siswa', [SiswaKelasController::class, 'tambahSiswaKeKelas'])->name('kelas.tambah-siswa');
        Route::delete('/kelas/{kelasId}/siswa/{siswaId}', [SiswaKelasController::class, 'hapusSiswaDariKelas'])->name('kelas.hapus-siswa');
        Route::get('/kelas/{kelasId}/siswa', [SiswaKelasController::class, 'daftarSiswaKelas'])->name('kelas.daftar-siswa');
    });

    // Materi pembelajaran
    Route::prefix('kelas/{kelasId}/materi')->name('materi_pembelajaran.')->group(function () {
        Route::get('/', [MateriPembelajaranController::class, 'index'])->name('index');
        Route::get('/create', [MateriPembelajaranController::class, 'create'])->name('create');
        Route::post('/', [MateriPembelajaranController::class, 'store'])->name('store');
        Route::get('/{materiId}', [MateriPembelajaranController::class, 'show'])->name('show');
        Route::get('/{materiId}/edit', [MateriPembelajaranController::class, 'edit'])->name('edit');
        Route::put('/{materiId}', [MateriPembelajaranController::class, 'update'])->name('update');
        Route::delete('/{materiId}', [MateriPembelajaranController::class, 'destroy'])->name('destroy');
    });

    // Reports & other guru features
    Route::get('/laporan-siswa', [GuruController::class, 'laporanSiswa'])->name('laporan_siswa.index');
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

    // Pembayaran & other actions
    Route::get('/pembayaran', [GuruController::class, 'pembayaran'])->name('pembayaran.index');
    Route::post('/pembayaran/upload-qris', [GuruController::class, 'uploadQris'])->name('pembayaran.upload_qris');
    Route::put('/pembayaran/{id}/verify', [GuruController::class, 'verifyPembayaran'])->name('pembayaran.verify');

    Route::post('/upload-image', [TinyMceUploadController::class, 'upload'])->name('upload.image');
    Route::get('/siswa', [GuruController::class, 'siswa'])->name('siswa.index');
    Route::get('/laporan', [GuruController::class, 'laporan'])->name('laporan.index');
    Route::get('/transaksi', [GuruController::class, 'transaksi'])->name('transaksi.index');
    Route::get('/profil', [GuruController::class, 'profil'])->name('profil.index');
    Route::put('/profil', [GuruController::class, 'updateProfil'])->name('profil.update');
});

/* ------------------ Siswa ------------------ */
Route::prefix('siswa')->name('siswa.')->middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/dashboard', [SiswaController::class, 'dashboard'])->name('dashboard');

    Route::get('/kelas', [SiswaController::class, 'kelas'])->name('kelas.index');
    Route::get('/kelas/riwayat', [SiswaController::class, 'riwayatKelas'])->name('kelas.riwayat');
    Route::get('/kelas/{kelas}/materi/{materi?}', [SiswaKelasController::class, 'read'])->name('kelas.read');
    Route::post('/kelas/{kelas}/materi/{materi}/complete', [SiswaKelasController::class, 'markComplete'])->name('kelas.materi.complete');

    Route::get('/tugas', [SiswaController::class, 'tugas'])->name('tugas.index');

    Route::get('/pembayaran', [SiswaController::class, 'pembayaran'])->name('pembayaran.index');
    Route::post('/pembayaran', [SiswaController::class, 'storePembayaran'])->name('pembayaran.store');

    Route::get('/transaksi', [SiswaController::class, 'transaksi'])->name('transaksi.index');

    Route::get('/profil', [SiswaController::class, 'profil'])->name('profil.index');
    Route::put('/profil', [SiswaController::class, 'updateProfil'])->name('profil.update');

    Route::post('/catatan', [SiswaController::class, 'storeCatatan'])->name('catatan.store');
});

/* ------------------ Public pages ------------------ */

// public jenjang (sd, smp, sma)
Route::get('/jenjang/{jenjang}', [KelasController::class, 'publicByJenjang'])->name('jenjang.index');

// guru daftar page (public)
Route::get('/guru/Daftar', function () {
    return view('guru.index');
})->name('guru.index');

// contact
Route::get('/kontak', [ContactController::class, 'page'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'send'])->name('kontak.kirim');

// helper dashboard redirects (keperluan debug / sample)
Route::get('/dashboard/siswa', function () {
    return 'Dashboard Siswa';
})->name('dashboard.siswa')->middleware('auth');

Route::get('/dashboard/guru', function () {
    return 'Dashboard Guru';
})->name('dashboard.guru')->middleware('auth');

Route::get('/dashboard/admin', function () {
    return 'Dashboard Admin';
})->name('dashboard.admin')->middleware('auth');

Route::get('/dashboard/pengunjung', function () {
    return 'Dashboard Pengunjung';
})->name('dashboard.pengunjung')->middleware('auth');

// halaman daftar (public)
Route::get('/daftar', function () {
    return view('daftar');
})->name('daftar');
