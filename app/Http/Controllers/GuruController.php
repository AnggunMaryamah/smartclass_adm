<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Pembayaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class GuruController extends Controller
{
    public function dashboard()
    {
        $guru = Guru::first();
        if (!$guru) {
            return 'Tidak ada data guru, silakan insert minimal 1.';
        }

        $jumlahKelas  = Kelas::where('guru_id', $guru->id)->count();
        $kelasAktif   = Kelas::where('guru_id', $guru->id)->where('status', 'aktif')->count();
        $jumlahSiswa  = Kelas::where('guru_id', $guru->id)->sum('jumlah_siswa');
        $kelasPopular = Kelas::where('guru_id', $guru->id)
            ->orderBy('jumlah_siswa', 'desc')
            ->take(5)
            ->get();

        // Data tambahan (dummy)
        $jumlahLaporan    = 0;
        $totalPembayaran  = 0;
        $totalTransaksi   = 0;
        $persentaseTarget = 0;
        $chartData        = [16, 24, 20, 27, 31, 22];

        return view('guru.dashboard', compact(
            'jumlahKelas','kelasAktif','jumlahSiswa','kelasPopular',
            'jumlahLaporan','totalPembayaran','totalTransaksi','persentaseTarget','chartData'
        ));
    }

    // ================= KELAS =================
    public function indexKelas(Request $request)
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru.';

        $query = Kelas::where('guru_id', $guru->id);

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_kelas', 'like', '%'.$request->search.'%')
                  ->orWhere('deskripsi', 'like', '%'.$request->search.'%');
            });
        }

        if ($request->filled('jenjang')) {
            $query->where('jenjang_pendidikan', $request->jenjang);
        }

        $daftarKelas = $query->latest()->paginate(10);

        return view('guru.kelas.index', compact('daftarKelas'));
    }

    public function createKelas()
    {
        return view('guru.kelas.create');
    }

    public function storeKelas(Request $request)
    {
        Log::info('=== STORE KELAS CALLED ===', $request->all());

        $guru = Guru::first();
        if (!$guru) {
            return back()->with('error', 'Tidak ada data guru. Silakan hubungi administrator.');
        }

        $validated = $request->validate([
            'nama_kelas'         => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|in:SD,SMP,SMA',
            'harga'              => 'required|integer|min:0',
            'durasi'             => 'required|string',
            'durasi_custom'      => 'nullable|string|max:100',
            'deskripsi'          => 'nullable|string',
        ]);

        try {
            $durasi = $validated['durasi'];
            if ($durasi === 'custom' && !empty($validated['durasi_custom'])) {
                $durasi = $validated['durasi_custom'];
            }

            $kelas = Kelas::create([
                'guru_id'            => $guru->id,
                'nama_kelas'         => $validated['nama_kelas'],
                'jenjang_pendidikan' => $validated['jenjang_pendidikan'],
                'harga'              => $validated['harga'],
                'durasi'             => $durasi,
                'deskripsi'          => $validated['deskripsi'] ?? null,
                'status'             => 'aktif',
                'jumlah_siswa'       => 0,
            ]);

            Log::info('Kelas created successfully', $kelas->toArray());

            return redirect()->route('guru.kelas.index')
                ->with('success', 'Kelas berhasil ditambahkan!');
        } catch (\Exception $e) {
            Log::error('Error creating kelas', [
                'message' => $e->getMessage(),
                'line'    => $e->getLine(),
                'file'    => $e->getFile(),
            ]);

            return back()->withInput()
                ->with('error', 'Gagal menambahkan kelas: ' . $e->getMessage());
        }
    }

    public function showKelas($id)
    {
        $guru = Guru::first();
        if (!$guru) abort(404, 'Belum ada data guru di database. Silakan buat guru dulu.');

        $kelas = Kelas::where('id', $id)
            ->where('guru_id', $guru->id)
            ->firstOrFail();

        $siswas      = collect();
        $totalSiswa  = 0;
        $totalMateri = 0;

        try { $siswas = $kelas->siswas; $totalSiswa = $siswas->count(); } catch (\Exception $e) {}
        try { $totalMateri = $kelas->materiPembelajarans()->count(); } catch (\Exception $e) {}

        return view('guru.kelas.show', compact('kelas', 'siswas', 'totalSiswa', 'totalMateri'));
    }

    public function editKelas($id)
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru.';

        $kelas = Kelas::where('id', $id)->where('guru_id', $guru->id)->firstOrFail();

        return view('guru.kelas.edit', compact('kelas'));
    }

    public function updateKelas(Request $request, $id)
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru.';

        $kelas = Kelas::where('id', $id)->where('guru_id', $guru->id)->firstOrFail();

        $validated = $request->validate([
            'nama_kelas'         => 'required|string|max:255',
            'jenjang_pendidikan' => 'required|in:SD,SMP,SMA',
            'harga'              => 'required|integer|min:0',
            'durasi'             => 'required|string',
            'durasi_custom'      => 'nullable|string|max:100',
            'deskripsi'          => 'nullable|string',
            'status'             => 'nullable|in:aktif,nonaktif',
        ]);

        try {
            $durasi = $validated['durasi'];
            if ($durasi === 'custom' && !empty($validated['durasi_custom'])) {
                $durasi = $validated['durasi_custom'];
            }

            $kelas->update([
                'nama_kelas'         => $validated['nama_kelas'],
                'jenjang_pendidikan' => $validated['jenjang_pendidikan'],
                'harga'              => $validated['harga'],
                'durasi'             => $durasi,
                'deskripsi'          => $validated['deskripsi'] ?? null,
                'status'             => $validated['status'] ?? $kelas->status,
            ]);

            return redirect()->route('guru.kelas.index')
                ->with('success', 'Kelas berhasil diperbarui!');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Gagal memperbarui kelas: ' . $e->getMessage());
        }
    }

    public function destroyKelas($id)
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru.';

        $kelas = Kelas::where('id', $id)->where('guru_id', $guru->id)->firstOrFail();

        if ($kelas->jumlah_siswa > 0) {
            return back()->with('error', 'Tidak dapat menghapus kelas yang masih memiliki siswa aktif!');
        }

        $kelas->delete();

        return redirect()->route('guru.kelas.index')
            ->with('success', 'Kelas berhasil dihapus!');
    }

    public function toggleStatusKelas($id)
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru.';

        $kelas = Kelas::where('id', $id)->where('guru_id', $guru->id)->firstOrFail();
        $kelas->status = $kelas->status === 'aktif' ? 'nonaktif' : 'aktif';
        $kelas->save();

        return back()->with('success', 'Status kelas berhasil diubah!');
    }

    // ================= PEMBAYARAN =================
    public function pembayaran()
    {
        $guru = Guru::first();
        if (!$guru) return back()->with('error', 'Data guru tidak ditemukan');

        $pembayarans = Pembayaran::with(['pemesanan.siswa', 'pemesanan.kelas'])
            ->whereHas('pemesanan.kelas', function ($q) use ($guru) {
                $q->where('guru_id', $guru->id);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        $totalPembayaran = $pembayarans->count();
        $menunggu        = $pembayarans->where('status_pembayaran', 'menunggu')->count();
        $lunas           = $pembayarans->where('status_pembayaran', 'lunas')->count();
        $totalPemasukan  = $pembayarans->where('status_pembayaran', 'lunas')->sum('nominal_pembayaran');

        return view('guru.pembayaran.index', compact(
            'guru','pembayarans','totalPembayaran','menunggu','lunas','totalPemasukan'
        ));
    }

    // Upload / update QRIS guru
    public function uploadQris(Request $request)
    {
        $guru = Guru::first();
        if (!$guru) return back()->with('error', 'Guru tidak ditemukan');

        $request->validate([
            'qris_image'     => $guru->qris_image ? 'nullable|image|mimes:jpg,jpeg,png|max:2048' : 'required|image|mimes:jpg,jpeg,png|max:2048',
            'qris_nama_bank' => 'required|string|max:100',
            'qris_catatan'   => 'nullable|string|max:500',
        ]);

        if ($request->hasFile('qris_image')) {
            if ($guru->qris_image && Storage::disk('public')->exists($guru->qris_image)) {
                Storage::disk('public')->delete($guru->qris_image);
            }
            $guru->qris_image = $request->file('qris_image')->store('qris', 'public');
        }

        $guru->qris_nama_bank = $request->qris_nama_bank;
        $guru->qris_catatan   = $request->qris_catatan;
        $guru->save();

        return redirect()->route('guru.pembayaran.index')->with('success', 'QRIS berhasil diperbarui.');
    }

    // Verifikasi pembayaran (lunas / gagal)
    public function verifyPembayaran(Request $request, $id)
    {
        $guru = Guru::first();
        if (!$guru) return back()->with('error', 'Guru tidak ditemukan');

        $request->validate([
            'status' => 'required|in:lunas,gagal',
        ]);

        $pembayaran = Pembayaran::with('pemesanan.kelas')->findOrFail($id);

        // pastikan pembayaran milik kelas guru ini
        if (optional(optional($pembayaran->pemesanan)->kelas)->guru_id !== $guru->id) {
            return back()->with('error', 'Anda tidak berhak memverifikasi pembayaran ini.');
        }

        $pembayaran->status_pembayaran = $request->status;
        $pembayaran->verified_by       = $guru->id;
        $pembayaran->verified_at       = now();
        if ($request->status === 'lunas') {
            $pembayaran->tanggal_pembayaran = now();
        }
        $pembayaran->save();

        return back()->with('success', $request->status === 'lunas'
            ? 'Pembayaran ditandai LUNAS.'
            : 'Pembayaran ditolak.');
    }

    // ================= LAINNYA =================
    public function transaksi()
    {
        return view('guru.transaksi.index');
    }

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

    // ========== LAPORAN SISWA ==========
    public function laporanSiswa()
    {
        $guru = Guru::first();
        if (!$guru) return 'Tidak ada data guru. Silakan tambahkan minimal 1 guru di database.';

        $kelasList = Kelas::where('guru_id', $guru->id)
            ->withCount('siswas')
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
                $q->where('kelas.id', $kelasId);
            })
            ->paginate(10);

        return view('guru.laporan_siswa.daftar', compact('kelas', 'daftarSiswa'));
    }

    public function laporanSiswaDetailSatuan($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);

        $laporan = \App\Models\LaporanHasilBelajar::where('siswa_id', $siswa_id)->get();

        $totalKuis       = $laporan->where('jenis_penilaian', 'kuis')->count();
        $kuisDikerjakan  = $laporan->where('jenis_penilaian', 'kuis')->where('nilai', '!=', null)->count();

        $totalUjian      = $laporan->where('jenis_penilaian', 'ujian')->count();
        $ujianDikerjakan = $laporan->where('jenis_penilaian', 'ujian')->where('nilai', '!=', null)->count();

        $totalMateri   = $laporan->groupBy('materi_pembelajaran')->count();
        $materiSelesai = $laporan->where('nilai', '!=', null)->groupBy('materi_pembelajaran')->count();
        $progressMateri = $totalMateri > 0 ? round(($materiSelesai / $totalMateri) * 100) : 0;

        return view('guru.laporan_siswa.detail', compact(
            'siswa','laporan','totalKuis','kuisDikerjakan',
            'totalUjian','ujianDikerjakan','progressMateri','materiSelesai','totalMateri'
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
        $kelas = \App\Models\Kelas::findOrFail($kelas_id);
        $siswa = \App\Models\Siswa::findOrFail($siswa_id);

        $laporan = \App\Models\LaporanHasilBelajar::where('siswa_id', $siswa_id)
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
        $siswa = \App\Models\Siswa::findOrFail($siswa_id);

        $laporan = \App\Models\LaporanHasilBelajar::where('siswa_id', $siswa_id)
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
                if     ($nilai >= 90) $validated['predikat'] = 'A';
                elseif ($nilai >= 80) $validated['predikat'] = 'B';
                elseif ($nilai >= 70) $validated['predikat'] = 'C';
                elseif ($nilai >= 60) $validated['predikat'] = 'D';
                else                   $validated['predikat'] = 'E';
            }

            \App\Models\LaporanHasilBelajar::create($validated);

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
        $laporan = \App\Models\LaporanHasilBelajar::findOrFail($laporan_id);
        $siswa   = $laporan->siswa;

        return view('guru.laporan_siswa.edit', compact('laporan', 'siswa'));
    }

    public function updateLaporanSiswa(Request $request, $laporan_id)
    {
        $laporan = \App\Models\LaporanHasilBelajar::findOrFail($laporan_id);

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
                if     ($nilai >= 90) $validated['predikat'] = 'A';
                elseif ($nilai >= 80) $validated['predikat'] = 'B';
                elseif ($nilai >= 70) $validated['predikat'] = 'C';
                elseif ($nilai >= 60) $validated['predikat'] = 'D';
                else                   $validated['predikat'] = 'E';
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
            $laporan  = \App\Models\LaporanHasilBelajar::findOrFail($laporan_id);
            $siswa_id = $laporan->siswa_id;
            $laporan->delete();

            return redirect()
                ->route('guru.laporan_siswa.detail', $siswa_id)
                ->with('success', 'Laporan berhasil dihapus!');
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal menghapus laporan: ' . $e->getMessage());
        }
    }

    // Stub agar route 'guru.siswa.index' dan 'guru.laporan.index' tidak error
    public function siswa()   { return view('guru.siswa.index'); }
    public function laporan() { return view('guru.laporan.index'); }
}
