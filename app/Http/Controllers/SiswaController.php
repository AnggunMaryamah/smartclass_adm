<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MateriProgress;
use App\Models\Pembayaran;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        if (! $siswa) {
            return view('siswa.dashboard', [
                'user' => $user,
                'kelasAktif' => 0,
                'kelasAktifList' => collect(),
                'kelasSelesai' => 0,
                'tugasBelumSelesai' => 0,
                'progressRataRata' => 0,
            ]);
        }

        $kelasAktifList = SiswaKelas::with([
            'kelas.guru',
            'kelas.materiPembelajaran',
        ])
            ->where('siswa_id', $siswa->id)
            ->where('status', 'aktif')
            ->get()
            ->map(function ($row) use ($user) {
                $kelas = $row->kelas;

                if (! $kelas) {
                    return null;
                }

                // ✅ PERBAIKAN: Hitung progress dengan groupBy untuk hindari duplikat
                $totalMateri = $kelas->materiPembelajaran->count();

                // Gunakan groupBy untuk ambil materi unik saja
                $completedMateri = MateriProgress::where('user_id', $user->id)
                    ->where('kelas_id', $kelas->id)
                    ->where('is_completed', true)
                    ->select('materi_id')
                    ->groupBy('materi_id')
                    ->get()
                    ->count();

                // ✅ Batasi progress maksimal 100%
                $progress = $totalMateri > 0
                    ? min(round(($completedMateri / $totalMateri) * 100), 100)
                    : 0;

                return (object) [
                    'id' => $kelas->id,
                    'nama' => $kelas->nama_kelas,
                    'jenjang' => $kelas->jenjang_pendidikan,
                    'guru' => $kelas->guru,
                    'progress' => $progress,
                    'total_materi' => $totalMateri,
                    'total_tugas' => 0,
                ];
            })
            ->filter();

        $kelasAktif = $kelasAktifList->count();
        $kelasSelesai = $kelasAktifList->where('progress', '>=', 100)->count();

        // ✅ Batasi progress rata-rata juga
        $progressRataRata = $kelasAktif > 0
            ? min(round($kelasAktifList->avg('progress')), 100)
            : 0;

        $tugasBelumSelesai = 0;

        return view('siswa.dashboard', [
            'user' => $user,
            'kelasAktif' => $kelasAktif,
            'kelasAktifList' => $kelasAktifList,
            'kelasSelesai' => $kelasSelesai,
            'tugasBelumSelesai' => $tugasBelumSelesai,
            'progressRataRata' => $progressRataRata,
        ]);
    }
public function kelas()
{
    $user = Auth::user();
    
    // Cari siswa berdasarkan email user yang login
    $siswa = \App\Models\Siswa::where('email', $user->email)->first();
    
    if (!$siswa) {
        return redirect()->route('siswa.dashboard')
            ->with('error', 'Data siswa tidak ditemukan. Silakan hubungi admin.');
    }
    
    // Ambil semua kelas siswa (aktif dan selesai)
    $kelasList = \App\Models\SiswaKelas::where('siswa_id', $siswa->id)
        ->with('kelas.materiPembelajaran')
        ->get();
    
    return view('siswa.kelas.index', compact('kelasList'));
}

    public function riwayatKelas()
    {
        return view('siswa.kelas.riwayat');
    }

    public function tugas()
    {
        return view('siswa.tugas.index');
    }

    public function pembayaran()
    {
        $siswa = auth()->user()->siswa;

        $pembayaranList = Pembayaran::with(['pemesanan.kelas'])
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.pembayaran.index', compact('pembayaranList'));
    }

    public function showPembayaran(Pembayaran $pembayaran)
    {
        // opsional: pastikan ini pembayaran milik siswa yang login
        $siswa = auth()->user()->siswa;
        abort_if($pembayaran->siswa_id !== $siswa->id, 403);

        return view('siswa.pembayaran.show', compact('pembayaran'));
    }

    public function storePembayaran(Request $request)
    {
        // validasi sederhana contoh
        $request->validate([
            'pembayaran_id' => 'required|exists:pembayarans,id',
            'bukti_pembayaran' => 'required|image|max:2048',
        ]);

        // simpan file ke storage/app/public/bukti_pembayaran
        $path = $request->file('bukti_pembayaran')
            ->store('bukti_pembayaran', 'public');

        // ambil record pembayaran yg mau di‑update
        $pembayaran = Pembayaran::findOrFail($request->pembayaran_id);

        // update kolom bukti_pembayaran dengan path file
        $pembayaran->update([
            'bukti_pembayaran' => $path,
        ]);

        return back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    public function transaksi()
    {
        return view('siswa.transaksi.index');
    }

    public function profil()
    {
        $user = Auth::user();

        return view('siswa.profil.index', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Auth::user()->update($request->only(['name']));

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
    }

    public function storeCatatan(Request $request)
    {
        return redirect()->back()->with('success', 'Catatan berhasil disimpan');
    }

    /**
     * Halaman membaca materi dengan sidebar (route: siswa.kelas.read)
     */
    public function kelasRead($kelasId, Request $request)
    {
        $user = Auth::user();

        // Ambil data siswa
        $siswa = Siswa::where('email', $user->email)->first();

        if (! $siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        // Load kelas dengan relasi
        $kelas = Kelas::with([
            'guru',
            'materiPembelajaran' => function ($q) {
                $q->orderBy('bab', 'asc')->orderBy('urutan', 'asc');
            },
            'materiPembelajaran.tugas' => function ($q) {
                $q->where('status', 'active');
            },
        ])->findOrFail($kelasId);

        // Cek akses siswa ke kelas ini
        $aksesKelas = SiswaKelas::where('siswa_id', $siswa->id)
            ->where('kelas_id', $kelasId)
            ->where('status', 'aktif')
            ->first();

        if (! $aksesKelas) {
            return redirect()->route('siswa.kelas.index')
                ->with('error', 'Anda tidak memiliki akses ke kelas ini');
        }

        // Ambil semua materi di kelas ini
        $materiList = $kelas->materiPembelajaran;

        // Tentukan materi yang sedang dibuka
        $materiId = $request->input('materi') ?? $request->route('materi');

        if ($materiId) {
            $currentMateri = $materiList->firstWhere('id', $materiId);
        } else {
            // Jika tidak ada parameter materi, ambil materi pertama
            $currentMateri = $materiList->first();
        }

        // Jika buka materi, tandai sebagai sedang dibaca
        if ($currentMateri) {
            MateriProgress::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'kelas_id' => $kelasId,
                    'materi_id' => $currentMateri->id,
                ],
                [
                    'is_completed' => false, // Akan diupdate saat user klik "Tandai Selesai"
                    'last_read_at' => now(),
                ]
            );
        }

        // Ambil ID materi yang sudah selesai
        $completedIds = MateriProgress::where('user_id', $user->id)
            ->where('kelas_id', $kelasId)
            ->where('is_completed', true)
            ->pluck('materi_id')
            ->toArray();

        // Hitung progress
        $totalMateri = $materiList->count();
        $completedMateriCount = MateriProgress::where('user_id', $user->id)
            ->where('kelas_id', $kelasId)
            ->where('is_completed', true)
            ->select('materi_id')
            ->groupBy('materi_id')
            ->get()
            ->count();

        $progressPersen = $totalMateri > 0
            ? min(round(($completedMateriCount / $totalMateri) * 100), 100)
            : 0;

        // Group materi by bab
        $groupedMateri = $materiList->groupBy('bab');

        // Ambil catatan belajar (jika ada fitur catatan)
        $catatan = collect([]); // Untuk sekarang kosong, nanti bisa ditambahkan

        return view('siswa.kelas.read', [
            'kelas' => $kelas,
            'siswa' => $siswa,
            'currentMateri' => $currentMateri,
            'materiList' => $materiList,
            'groupedMateri' => $groupedMateri,
            'completedIds' => $completedIds,
            'progressPersen' => $progressPersen,
            'catatan' => $catatan,
        ]);
    }

    /**
     * Tandai materi sebagai selesai
     */
    public function markMateriComplete(Request $request, $kelasId, $materiId)
    {
        $user = Auth::user();

        MateriProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'kelas_id' => $kelasId,
                'materi_id' => $materiId,
            ],
            [
                'is_completed' => true,
                'completed_at' => now(),
                'last_read_at' => now(),
            ]
        );

        return response()->json([
            'success' => true,
            'message' => 'Materi berhasil ditandai selesai',
        ]);
    }

    /**
     * Batalkan tandai materi selesai
     */
    public function unmarkMateriComplete(Request $request, $kelasId, $materiId)
    {
        $user = Auth::user();

        MateriProgress::where('user_id', $user->id)
            ->where('kelas_id', $kelasId)
            ->where('materi_id', $materiId)
            ->update([
                'is_completed' => false,
                'completed_at' => null,
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Status selesai dibatalkan',
        ]);
    }
}
