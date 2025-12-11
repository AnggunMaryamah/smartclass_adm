<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use App\Models\Pembayaran;
use App\Models\LaporanHasilBelajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{
    // ================= DASHBOARD =================
    public function index()
{
    $guru = Guru::first();
    if (!$guru) return 'Tidak ada data guru.';

    $totalKelas = Kelas::where('guru_id', $guru->id)->count();

    $totalSiswa = SiswaKelas::where('status', 'aktif')
        ->whereHas('kelas', function ($q) use ($guru) {
            $q->where('guru_id', $guru->id);
        })
        ->distinct('siswa_id')
        ->count('siswa_id');

    // total laporan
    $jumlahLaporan = LaporanHasilBelajar::count();

    // ambil semua id kelas milik guru
$kelasIds = Kelas::where('guru_id', $guru->id)->pluck('id');

// total pemasukan pembayaran lunas untuk kelas-kelas guru
$totalPembayaran = Pembayaran::where('status_pembayaran', 'lunas')
    ->whereIn('kelas_id', $kelasIds)
    ->sum('nominal_pembayaran');

    return view('guru.dashboard', compact(
        'guru',
        'totalKelas',
        'totalSiswa',
        'jumlahLaporan',
        'totalPembayaran'
    ));
}
    // ================= PEMBAYARAN (READ ONLY) =================
    public function pembayaran()
    {
        $guru = Guru::first();
        if (!$guru) return back()->with('error', 'Data guru tidak ditemukan');

        // Ambil semua kelas yang diampu guru
        $kelasIds = Kelas::where('guru_id', $guru->id)->pluck('id');

        // Ambil pembayaran dari siswa di kelas-kelas itu
        $pembayarans = Pembayaran::with(['siswa', 'kelas'])
            ->whereIn('kelas_id', $kelasIds)
            ->orderBy('created_at', 'desc')
            ->get();

        // Hitung statistik sederhana
        $total    = $pembayarans->count();
        $menunggu = $pembayarans->where('status_pembayaran', 'menunggu')->count();
        $lunas    = $pembayarans->where('status_pembayaran', 'lunas')->count();
        $gagal    = $pembayarans->where('status_pembayaran', 'gagal')->count();

        return view('guru.pembayaran.index', compact(
            'pembayarans',
            'total',
            'menunggu',
            'lunas',
            'gagal'
        ));
    }

    // ================= KELAS =================
    public function kelas()
{
    $guru = Guru::first();
    if (!$guru) return 'Tidak ada data guru.';

    // ganti nama variabel jadi $daftarKelas
    $daftarKelas = Kelas::where('guru_id', $guru->id)
        ->withCount(['siswas as total_siswa' => function ($q) {
            $q->where('siswa_kelas.status', 'aktif');
        }])
        ->paginate(10); // boleh pakai get() kalau tidak butuh pagination

    return view('guru.kelas.index', compact('daftarKelas'));
}

    public function kelasCreate()
    {
        return view('guru.kelas.create');
    }

    public function kelasStore(Request $request)
    {
        $guru = Guru::first();
        if (!$guru) return back()->with('error', 'Guru tidak ditemukan.');

        $validated = $request->validate([
            'nama_kelas'     => 'required|string|max:100',
            'deskripsi'      => 'nullable|string',
            'tahun_ajaran'   => 'required|string|max:20',
            'harga'          => 'required|numeric|min:0',
            'foto_kelas'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validated['guru_id'] = $guru->id;

        if ($request->hasFile('foto_kelas')) {
            $validated['foto_kelas'] = $request->file('foto_kelas')
                ->store('kelas', 'public');
        }

        Kelas::create($validated);

        return redirect()->route('guru.kelas.index')
            ->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function kelasEdit($id)
    {
        $kelas = Kelas::findOrFail($id);
        return view('guru.kelas.edit', compact('kelas'));
    }

    public function kelasUpdate(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $validated = $request->validate([
            'nama_kelas'   => 'required|string|max:100',
            'deskripsi'    => 'nullable|string',
            'tahun_ajaran' => 'required|string|max:20',
            'harga'        => 'required|numeric|min:0',
            'foto_kelas'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('foto_kelas')) {
            if ($kelas->foto_kelas && Storage::disk('public')->exists($kelas->foto_kelas)) {
                Storage::disk('public')->delete($kelas->foto_kelas);
            }
            $validated['foto_kelas'] = $request->file('foto_kelas')
                ->store('kelas', 'public');
        }

        $kelas->update($validated);

        return redirect()->route('guru.kelas.index')
            ->with('success', 'Kelas berhasil diperbarui!');
    }

    public function kelasDestroy($id)
    {
        $kelas = Kelas::findOrFail($id);

        if ($kelas->foto_kelas && Storage::disk('public')->exists($kelas->foto_kelas)) {
            Storage::disk('public')->delete($kelas->foto_kelas);
        }

        $kelas->delete();

        return redirect()->route('guru.kelas.index')
            ->with('success', 'Kelas berhasil dihapus!');
    }

    public function kelasDetail($id)
    {
        $kelas = Kelas::with('siswas')->findOrFail($id);

        $daftarSiswa = $kelas->siswas()
            ->wherePivot('status', 'aktif')
            ->get();

        return view('guru.kelas.detail', compact('kelas', 'daftarSiswa'));
    }

    // ================= SISWA =================
    public function siswa()
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru.';

        $pivot = SiswaKelas::with(['siswa', 'kelas'])
            ->where('status', 'aktif')
            ->whereHas('kelas', function ($q) use ($guru) {
                $q->where('guru_id', $guru->id);
            })
            ->get();

        $daftarSiswa = $pivot->groupBy('siswa_id')->map(function ($rows) {
            $row = $rows->first();
            $siswa = $row->siswa;
            $siswa->total_kelas = $rows->count();
            return $siswa;
        })->values();

        $totalSiswa = $daftarSiswa->count();
        $siswaAktif = $totalSiswa;
        $totalKelas = Kelas::where('guru_id', $guru->id)->count();

        return view('guru.siswa.index', compact(
            'daftarSiswa',
            'totalSiswa',
            'siswaAktif',
            'totalKelas'
        ));
    }

    // ================= LAPORAN SISWA =================
    public function laporan()
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru. Silakan tambahkan minimal 1 guru di database.';

        $kelasList = Kelas::where('guru_id', $guru->id)
            ->withCount(['siswas as total_siswa' => function ($q) {
                $q->where('siswa_kelas.status', 'aktif');
            }])
            ->get();

        return view('guru.laporan_siswa.index', compact('kelasList'));
    }

    public function laporanSiswaDaftarKelas($kelasId)
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru.';

        $kelas = Kelas::where('id', $kelasId)
            ->where('guru_id', $guru->id)
            ->with('siswas')
            ->firstOrFail();

        $daftarSiswa = Siswa::whereHas('kelas', function ($q) use ($kelasId) {
                $q->where('kelas.id', $kelasId)
                  ->where('siswa_kelas.status', 'aktif');
            })
            ->paginate(10);

        return view('guru.laporan_siswa.daftar', compact('kelas', 'daftarSiswa'));
    }

    public function laporanSiswaDetailSatuan($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        $laporan = LaporanHasilBelajar::where('siswa_id', $siswa_id)->get();

        $totalKuis       = $laporan->where('jenis_penilaian', 'kuis')->count();
        $kuisDikerjakan  = $laporan->where('jenis_penilaian', 'kuis')->where('nilai', '!=', null)->count();

        $totalUjian      = $laporan->where('jenis_penilaian', 'ujian')->count();
        $ujianDikerjakan = $laporan->where('jenis_penilaian', 'ujian')->where('nilai', '!=', null)->count();

        $totalMateri    = $laporan->groupBy('materi_pembelajaran')->count();
        $materiSelesai  = $laporan->where('nilai', '!=', null)->groupBy('materi_pembelajaran')->count();
        $progressMateri = $totalMateri > 0 ? round(($materiSelesai / $totalMateri) * 100) : 0;

        return view('guru.laporan_siswa.detail', compact(
            'siswa',
            'laporan',
            'totalKuis',
            'kuisDikerjakan',
            'totalUjian',
            'ujianDikerjakan',
            'progressMateri',
            'materiSelesai',
            'totalMateri'
        ));
    }

    public function updateCatatanUmum(Request $request, $siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        $validated = $request->validate([
            'catatan_umum' => 'nullable|string',
        ]);

        try {
            $siswa->update([
                'catatan_umum' => $validated['catatan_umum'] ?? null,
            ]);

            return back()->with('success', 'Catatan umum berhasil diperbarui.');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui catatan umum: ' . $e->getMessage());
        }
    }

    public function exportLaporanSiswaPdf($kelas_id, $siswa_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);
        $siswa = Siswa::findOrFail($siswa_id);

        $laporan = LaporanHasilBelajar::where('siswa_id', $siswa_id)
            ->where('kelas_id', $kelas_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('guru.laporan_siswa.pdf', compact('kelas', 'siswa', 'laporan'))
            ->setPaper('a4')
            ->setOption('enable_local_file_access', true);

        return $pdf->download('Laporan_' . $siswa->nama_lengkap . '_' . $kelas->nama_kelas . '.pdf');
    }

    public function exportLaporanSiswaPdfSimple($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        $laporan = LaporanHasilBelajar::where('siswa_id', $siswa_id)
            ->orderBy('created_at', 'desc')
            ->get();

        $pdf = Pdf::loadView('guru.laporan_siswa.pdf', compact('siswa', 'laporan'))
            ->setPaper('a4')
            ->setOption('enable_local_file_access', true);

        return $pdf->download('Laporan_' . ($siswa->nama_lengkap ?? 'Siswa') . '.pdf');
    }

    public function createLaporanSiswa($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        return view('guru.laporan_siswa.create', compact('siswa'));
    }

    public function storeLaporanSiswa(Request $request)
    {
        $validated = $request->validate([
            'siswa_id'            => 'required|exists:siswas,id',
            'jenis_penilaian'     => 'required|in:kuis,ujian',
            'materi_pembelajaran' => 'required|string|max:255',
            'nilai'               => 'required|integer|min:0|max:100',
            'predikat'            => 'nullable|in:A,B,C,D,E',
            'capaian_kompetensi'  => 'required|string',
            'catatan_guru'        => 'nullable|string',
        ]);

        try {
            if (empty($validated['predikat'])) {
                $nilai = $validated['nilai'];
                if      ($nilai >= 90) $validated['predikat'] = 'A';
                elseif  ($nilai >= 80) $validated['predikat'] = 'B';
                elseif  ($nilai >= 70) $validated['predikat'] = 'C';
                elseif  ($nilai >= 60) $validated['predikat'] = 'D';
                else                    $validated['predikat'] = 'E';
            }

            LaporanHasilBelajar::create($validated);

            return redirect()
                ->route('guru.laporan_siswa.detail', $validated['siswa_id'])
                ->with('success', 'Laporan berhasil ditambahkan!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal menambahkan laporan: ' . $e->getMessage());
        }
    }

    public function editLaporanSiswa($laporan_id)
    {
        $laporan = LaporanHasilBelajar::findOrFail($laporan_id);
        $siswa   = $laporan->siswa;

        return view('guru.laporan_siswa.edit', compact('laporan', 'siswa'));
    }

    public function updateLaporanSiswa(Request $request, $laporan_id)
    {
        $laporan = LaporanHasilBelajar::findOrFail($laporan_id);

        $validated = $request->validate([
            'jenis_penilaian'     => 'required|in:kuis,ujian',
            'materi_pembelajaran' => 'required|string|max:255',
            'nilai'               => 'required|integer|min:0|max:100',
            'predikat'            => 'nullable|in:A,B,C,D,E',
            'capaian_kompetensi'  => 'required|string',
            'catatan'             => 'nullable|string',
        ]);

        try {
            if (empty($validated['predikat'])) {
                $nilai = $validated['nilai'];
                if      ($nilai >= 90) $validated['predikat'] = 'A';
                elseif  ($nilai >= 80) $validated['predikat'] = 'B';
                elseif  ($nilai >= 70) $validated['predikat'] = 'C';
                elseif  ($nilai >= 60) $validated['predikat'] = 'D';
                else                    $validated['predikat'] = 'E';
            }

            $laporan->update($validated);

            return redirect()
                ->route('guru.laporan_siswa.detail', $laporan->siswa_id)
                ->with('success', 'Laporan berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui laporan: ' . $e->getMessage());
        }
    }

    public function destroyLaporanSiswa($laporan_id)
    {
        try {
            $laporan  = LaporanHasilBelajar::findOrFail($laporan_id);
            $siswa_id = $laporan->siswa_id;
            $laporan->delete();

            return redirect()
                ->route('guru.laporan_siswa.detail', $siswa_id)
                ->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }

    // ================= PROFIL =================
    public function profil()
    {
        $guru = Guru::first();
        return view('guru.profil.index', compact('guru'));
    }

    public function updateProfil(Request $request)
    {
        $guru = Guru::first();

        $validated = $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email|unique:gurus,email,' . $guru->id,
            'no_hp'          => 'nullable|string|max:20',
            'mata_pelajaran' => 'nullable|string|max:255',
        ]);

        $guru->update($validated);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    // ================= TRANSAKSI (placeholder) =================
    public function transaksi()
    {
        return view('guru.transaksi.index');
    }
}
