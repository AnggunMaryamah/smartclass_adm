<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    private function getAdminForDevelopment()
    {
        return Admin::where('email', 'admin@test.com')->first();
    }

    public function index(Request $request)
    {
        // Hitung data dari database
        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $kelasAktif = Kelas::count();
        $totalTransaksi = Pembayaran::where('status_pembayaran', 'lunas')->sum('nominal_pembayaran');
        
        // Filter jenjang dari query string
        $filterJenjang = $request->query('jenjang', 'semua');
        
        // Pemesanan per jenjang dengan filter
        $query = Pemesanan::join('kelas', 'pemesanans.kelas_id', '=', 'kelas.id')
                          ->join('siswas', 'pemesanans.siswa_id', '=', 'siswas.id')
                          ->select(
                              'pemesanans.*',
                              'kelas.nama_kelas',
                              'kelas.jenjang_pendidikan',
                              'siswas.nama_lengkap as nama_siswa'
                          )
                          ->where('pemesanans.status_pemesanan', 'booking');
        
        // Terapkan filter jenjang
        if ($filterJenjang !== 'semua') {
            $jenjangArray = explode('-', $filterJenjang); // Misal: "sd-smp" jadi ['sd','smp']
            $query->whereIn('kelas.jenjang_pendidikan', array_map('strtoupper', $jenjangArray));
        }
        
        $pemesananList = $query->orderBy('pemesanans.created_at', 'desc')->get();
        
        // Hitung total per jenjang untuk statistik
        $statSD = Pemesanan::join('kelas', 'pemesanans.kelas_id', '=', 'kelas.id')
                           ->where('kelas.jenjang_pendidikan', 'SD')
                           ->where('pemesanans.status_pemesanan', 'booking')
                           ->count();
        
        $statSMP = Pemesanan::join('kelas', 'pemesanans.kelas_id', '=', 'kelas.id')
                            ->where('kelas.jenjang_pendidikan', 'SMP')
                            ->where('pemesanans.status_pemesanan', 'booking')
                            ->count();
        
        $statSMA = Pemesanan::join('kelas', 'pemesanans.kelas_id', '=', 'kelas.id')
                            ->where('kelas.jenjang_pendidikan', 'SMA')
                            ->where('pemesanans.status_pemesanan', 'booking')
                            ->count();

        return view('admin.dashboard', compact(
            'totalGuru',
            'totalSiswa',
            'kelasAktif',
            'totalTransaksi',
            'pemesananList',
            'filterJenjang',
            'statSD',
            'statSMP',
            'statSMA'
        ));
    }
}
