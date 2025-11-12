<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\LaporanHasilBelajar;
use App\Models\Pembayaran;
use App\Models\Pemesanan;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    private function getGuruForDevelopment()
    {
        return Guru::where('email', 'guru@test.com')->first();
    }

    public function index()
    {
        $guru = $this->getGuruForDevelopment();
        
        if (!$guru) {
            return view('guru.dashboard', [
                'jumlahKelas' => 0,
                'jumlahSiswa' => 0,
                'laporanBaru' => 0,
                'totalTransaksi' => 0,
                'aktivitasBulanan' => collect([]),
                'persentaseTarget' => 0,
                'targetPendapatan' => 10000000,
                'progressKelas' => 0,
                'progressSiswa' => 0,
                'progressLaporan' => 0,
                'progressTransaksi' => 0
            ]);
        }

        $guruId = $guru->id;

        // 1. Hitung kelas
        $jumlahKelas = Kelas::where('guru_id', $guruId)->count();

        // 2. Hitung siswa
        $kelasIds = Kelas::where('guru_id', $guruId)->pluck('id');
        
        $jumlahSiswa = Pemesanan::whereIn('kelas_id', $kelasIds)
                                ->where('status_pemesanan', 'booking')
                                ->distinct('siswa_id')
                                ->count('siswa_id');

        // 3. Hitung laporan (FIX: pakai siswaIds, bukan guru_id)
        $siswaIds = Pemesanan::whereIn('kelas_id', $kelasIds)
                             ->pluck('siswa_id')
                             ->unique();
        
        $laporanBaru = LaporanHasilBelajar::whereIn('siswa_id', $siswaIds)
                                          ->where('status_laporan', 'dikirim')
                                          ->count();

        // 4. Total pembayaran
        $pemesananIds = Pemesanan::whereIn('kelas_id', $kelasIds)->pluck('id');
        
        $totalTransaksi = Pembayaran::whereIn('pemesanan_id', $pemesananIds)
                                    ->where('status_pembayaran', 'lunas')
                                    ->sum('nominal_pembayaran');

        // 5. Aktivitas bulanan
        $aktivitasBulanan = collect([
            ['bulan' => 1, 'total' => 5],
            ['bulan' => 2, 'total' => 8],
            ['bulan' => 3, 'total' => 6],
            ['bulan' => 4, 'total' => 10],
            ['bulan' => 5, 'total' => 7],
            ['bulan' => 6, 'total' => 12],
        ]);

        // 6. Target
        $targetPendapatan = $guru->target_pendapatan ?? 10000000;
        $persentaseTarget = $targetPendapatan > 0 
            ? min(round(($totalTransaksi / $targetPendapatan) * 100), 100)
            : 0;

        // 7. Progress
        $progressKelas = $jumlahKelas > 0 ? min(($jumlahKelas / 10) * 100, 100) : 0;
        $progressSiswa = $jumlahSiswa > 0 ? min(($jumlahSiswa / 50) * 100, 100) : 0;
        $progressLaporan = $laporanBaru > 0 ? min(($laporanBaru / 10) * 100, 100) : 0;
        $progressTransaksi = $persentaseTarget;

        return view('guru.dashboard', compact(
            'jumlahKelas',
            'jumlahSiswa',
            'laporanBaru',
            'totalTransaksi',
            'aktivitasBulanan',
            'persentaseTarget',
            'targetPendapatan',
            'progressKelas',
            'progressSiswa',
            'progressLaporan',
            'progressTransaksi'
        ));
    }

    public function kelas()
    {
        $guru = $this->getGuruForDevelopment();
        $kelasList = $guru ? Kelas::where('guru_id', $guru->id)->withCount('pemesanans')->get() : collect([]);
        return view('guru.kelas', compact('kelasList'));
    }

    public function laporan()
    {
        $guru = $this->getGuruForDevelopment();
        $laporanList = collect([]);
        
        if ($guru) {
            $kelasIds = Kelas::where('guru_id', $guru->id)->pluck('id');
            $siswaIds = Pemesanan::whereIn('kelas_id', $kelasIds)->pluck('siswa_id');
            $laporanList = LaporanHasilBelajar::whereIn('siswa_id', $siswaIds)
                                              ->with('siswa')
                                              ->paginate(20);
        }
        
        return view('guru.laporan', compact('laporanList'));
    }

    public function pembayaran()
    {
        $guru = $this->getGuruForDevelopment();
        $pembayaranList = collect([]);
        $totalPendapatan = 0;
        
        if ($guru) {
            $kelasIds = Kelas::where('guru_id', $guru->id)->pluck('id');
            $pemesananIds = Pemesanan::whereIn('kelas_id', $kelasIds)->pluck('id');
            
            $pembayaranList = Pembayaran::whereIn('pemesanan_id', $pemesananIds)
                                        ->with(['pemesanan'])
                                        ->paginate(20);
            
            $totalPendapatan = Pembayaran::whereIn('pemesanan_id', $pemesananIds)
                                         ->where('status_pembayaran', 'lunas')
                                         ->sum('nominal_pembayaran');
        }
        
        return view('guru.pembayaran', compact('pembayaranList', 'totalPendapatan'));
    }

    public function siswa()
    {
        $guru = $this->getGuruForDevelopment();
        $siswaList = collect([]);
        
        if ($guru) {
            $kelasIds = Kelas::where('guru_id', $guru->id)->pluck('id');
            $siswaList = Pemesanan::whereIn('kelas_id', $kelasIds)
                                  ->with(['siswa', 'kelas'])
                                  ->get();
        }
        
        return view('guru.siswa', compact('siswaList'));
    }

    public function transaksi()
    {
        return $this->pembayaran();
    }

    public function profil()
    {
        $guru = $this->getGuruForDevelopment();
        $user = $guru ? $guru->user : null;
        
        return view('guru.profil', compact('guru', 'user'));
    }
}
