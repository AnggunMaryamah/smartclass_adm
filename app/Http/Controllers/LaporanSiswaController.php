<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\User;
use App\Models\LaporanHasilBelajar;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanSiswaController extends Controller
{
    // Detail siswa + laporan hasil belajar + progress belajar (materi, kuis, ujian)
    public function detail($id)
    {
        // Cari user/siswa
        $siswa = User::with(['kelas'])->findOrFail($id);

        // Semua laporan hasil belajar siswa
        $laporan = LaporanHasilBelajar::where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Progress Materi
        $totalMateri = DB::table('materis')
            ->join('kelas', 'materis.kelas_id', '=', 'kelas.id')
            ->where('kelas.guru_id', auth()->id())
            ->count();

        $materiSelesai = DB::table('materi_progress')
            ->join('materis', 'materi_progress.materi_id', '=', 'materis.id')
            ->join('kelas', 'materis.kelas_id', '=', 'kelas.id')
            ->where('kelas.guru_id', auth()->id())
            ->where('materi_progress.siswa_id', $siswa->id)
            ->where('materi_progress.is_completed', true)
            ->count();

        $progressMateri = $totalMateri > 0 ? round(($materiSelesai / $totalMateri) * 100) : 0;

        // Progress Kuis
        $totalKuis = DB::table('kuis')
            ->join('kelas', 'kuis.kelas_id', '=', 'kelas.id')
            ->where('kelas.guru_id', auth()->id())
            ->count();

        $kuisDikerjakan = DB::table('kuis_results')
            ->join('kuis', 'kuis_results.kuis_id', '=', 'kuis.id')
            ->join('kelas', 'kuis.kelas_id', '=', 'kelas.id')
            ->where('kelas.guru_id', auth()->id())
            ->where('kuis_results.siswa_id', $siswa->id)
            ->distinct('kuis_id')
            ->count();

        // Progress Ujian
        $totalUjian = DB::table('ujians')
            ->join('kelas', 'ujians.kelas_id', '=', 'kelas.id')
            ->where('kelas.guru_id', auth()->id())
            ->count();

        $ujianDikerjakan = DB::table('ujian_results')
            ->join('ujians', 'ujian_results.ujian_id', '=', 'ujians.id')
            ->join('kelas', 'ujians.kelas_id', '=', 'kelas.id')
            ->where('kelas.guru_id', auth()->id())
            ->where('ujian_results.siswa_id', $siswa->id)
            ->distinct('ujian_id')
            ->count();

        // Kirim SEMUA data ke view
        return view('guru.laporan_siswa.detail', compact(
            'siswa',
            'laporan',
            'totalMateri',
            'materiSelesai',
            'progressMateri',
            'totalKuis',
            'kuisDikerjakan',
            'totalUjian',
            'ujianDikerjakan'
        ));
    }

    // Export PDF laporan hasil belajar siswa (optional)
    public function exportPdf($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        $laporan = LaporanHasilBelajar::where('siswa_id', $siswa_id)
            ->orderBy('materi_pembelajaran', 'asc')
            ->get();

        // Generate PDF
        $pdf = Pdf::loadView('laporan.pdf-siswa', compact('siswa', 'laporan'))
            ->setPaper('a4')
            ->setOption('enable_local_file_access', true);

        return $pdf->download('Laporan_' . $siswa->nama . '.pdf');
    }
}
