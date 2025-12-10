<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use App\Models\MateriProgress;
use App\Models\MateriPembelajaran;
class SiswaKelasController extends Controller
{
    /**
     * Tambahkan siswa ke kelas
     */
    public function tambahSiswaKeKelas(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id'
        ]);

        try {
            $siswa = Siswa::findOrFail($request->siswa_id);
            $kelas = Kelas::findOrFail($request->kelas_id);

            // VALIDASI 1: Cek jenjang pendidikan siswa dan kelas harus sama
            if ($siswa->jenjang_pendidikan && $siswa->jenjang_pendidikan !== $kelas->jenjang_pendidikan) {
                return back()->with('error', 
                    "Siswa dengan jenjang {$siswa->jenjang_pendidikan} tidak bisa masuk kelas jenjang {$kelas->jenjang_pendidikan}!"
                );
            }

            // VALIDASI 2: Cek apakah siswa sudah terdaftar di kelas ini
            if ($siswa->kelas()->where('kelas_id', $kelas->id)->exists()) {
                return back()->with('error', 'Siswa sudah terdaftar di kelas ini!');
            }

            // Tambahkan siswa ke kelas
            $siswa->kelas()->attach($kelas->id, [
                'tanggal_daftar' => now(),
                'status' => 'aktif',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Update jumlah siswa di kelas
            $kelas->increment('jumlah_siswa');

            return back()->with('success', 'Siswa berhasil ditambahkan ke kelas!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Hapus siswa dari kelas
     */
    public function hapusSiswaDariKelas($kelasId, $siswaId)
    {
        try {
            $siswa = Siswa::findOrFail($siswaId);
            $kelas = Kelas::findOrFail($kelasId);

            $siswa->kelas()->detach($kelasId);
            
            // Update jumlah siswa di kelas
            $kelas->decrement('jumlah_siswa');

            return back()->with('success', 'Siswa berhasil dihapus dari kelas!');

        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Tampilkan siswa di kelas tertentu
     */
    public function daftarSiswaKelas($kelasId)
    {
        $kelas = Kelas::with(['siswas' => function($query) {
            $query->orderBy('nama_lengkap', 'asc');
        }])->findOrFail($kelasId);

        return view('guru.kelas.siswa', compact('kelas'));
    }
    public function read(Kelas $kelas, $materi = null)
    {
        $user  = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        // Cek siswa terdaftar
        $terdaftar = SiswaKelas::where('siswa_id', $siswa->id ?? null)
            ->where('kelas_id', $kelas->id)
            ->where('status', 'aktif')
            ->exists();

        if (!$terdaftar) {
            abort(403, 'Kamu belum terdaftar di kelas ini.');
        }

        // Ambil semua materi pembelajaran
        $materiList = $kelas->materiPembelajaran()
            ->orderBy('urutan')
            ->get();

        // Tentukan current materi
        if ($materi) {
            $currentMateri = $materiList->firstWhere('id', $materi);
        } else {
            $currentMateri = $materiList->first();
        }

        // ⬇️ KODE PREV/NEXT DITARUH DI SINI ⬇️
        $prevMateri = null;
        $nextMateri = null;

        if ($currentMateri) {
            $currentIndex = $materiList->search(fn ($m) => $m->id === $currentMateri->id);

            if ($currentIndex !== false) {
                if ($currentIndex > 0) {
                    $prevMateri = $materiList[$currentIndex - 1];
                }
                if ($currentIndex < $materiList->count() - 1) {
                    $nextMateri = $materiList[$currentIndex + 1];
                }
            }
        }
        $completedMateriIds = MateriProgress::where('user_id', $user->id)
        ->where('kelas_id', $kelas->id)
        ->where('is_completed', true)
        ->pluck('materi_id')
        ->toArray();

        return view('siswa.kelas.read', [
            'kelas'              => $kelas,
            'materiList'         => $materiList,
            'currentMateri'      => $currentMateri,
            'prevMateri'         => $prevMateri,
            'nextMateri'         => $nextMateri,
            'completedMateriIds' => $completedMateriIds,
        ]);
    }
 public function markComplete(Kelas $kelas, MateriPembelajaran $materi)
{
    $user = Auth::user();

    MateriProgress::updateOrCreate(
        [
            'user_id'   => $user->id,
            'kelas_id'  => $kelas->id,
            'materi_id' => $materi->id,
        ],
        [
            'is_completed' => true,
            'completed_at' => now(),
        ]
    );

    // ⬇️ TAMBAHKAN perhitungan progress di sini ⬇️
    $total = $kelas->materiPembelajaran()->count();
    $done  = MateriProgress::where('user_id', $user->id)
        ->where('kelas_id', $kelas->id)
        ->where('is_completed', true)
        ->count();

    $progress = $total > 0 ? round(($done / $total) * 100) : 0;

    // ⬇️ UBAH respon JSON-nya jadi seperti ini ⬇️
    return response()->json([
        'success'   => true,
        'progress'  => $progress,
        'completed' => $done,
        'total'     => $total,
    ]);
}
}
