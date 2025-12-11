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
    public function read(Kelas $kelas, $materiId = null)
{
    $user = Auth::user();
    $siswa = Siswa::where('email', $user->email)->first();

    if (!$siswa) {
        return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
    }

    // Cek enrollment
    $isEnrolled = SiswaKelas::where('siswa_id', $siswa->id)
        ->where('kelas_id', $kelas->id)
        ->exists();

    if (!$isEnrolled) {
        return redirect()->route('siswa.kelas.index')->with('error', 'Anda tidak terdaftar di kelas ini');
    }

    // ✅ Load materi dengan relasi tugas (kuis/ujian)
    $materiList = MateriPembelajaran::where('kelas_id', $kelas->id)
        ->with(['tugas' => function($query) {
            $query->whereIn('tipe', ['kuis', 'ujian', 'ujian_bab']);
        }])
        ->orderBy('urutan', 'asc')
        ->get();

    // Tentukan materi yang sedang dibaca
    if ($materiId) {
        $currentMateri = $materiList->firstWhere('id', $materiId);
    } else {
        $currentMateri = $materiList->first();
    }

    // Hitung prev/next materi
    $currentIndex = $materiList->search(function($item) use ($currentMateri) {
        return $item->id === optional($currentMateri)->id;
    });

    $prevMateri = $currentIndex > 0 ? $materiList[$currentIndex - 1] : null;
    $nextMateri = $currentIndex !== false && $currentIndex < $materiList->count() - 1 
        ? $materiList[$currentIndex + 1] 
        : null;

    // Hitung completed materi
    $completedMateriIds = MateriProgress::where('user_id', $user->id)
        ->where('kelas_id', $kelas->id)
        ->where('is_completed', true)
        ->pluck('materi_id')
        ->toArray();

    

    return view('siswa.kelas.read', [
        'kelas' => $kelas,
        'materiList' => $materiList,
        'currentMateri' => $currentMateri,
        'prevMateri' => $prevMateri,
        'nextMateri' => $nextMateri,
        'completedMateriIds' => $completedMateriIds,
        'user' => $user,
        'siswa' => $siswa,
    ]);
}

 public function markComplete(Kelas $kelas, MateriPembelajaran $materi)
{
    $user = Auth::user();

    // ✅ BENAR: updateOrCreate untuk hindari duplikat
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

    // ✅ PERBAIKAN: Hitung total materi
    $total = $kelas->materiPembelajaran()->count();
    
    // ✅ PERBAIKAN: Hitung materi completed UNIK dengan groupBy
    $done = MateriProgress::where('user_id', $user->id)
        ->where('kelas_id', $kelas->id)
        ->where('is_completed', true)
        ->select('materi_id')
        ->groupBy('materi_id')
        ->get()
        ->count();

    // ✅ PERBAIKAN: Batasi progress maksimal 100%
    $progress = $total > 0 ? min(round(($done / $total) * 100), 100) : 0;

    // ✅ Return JSON response
    return response()->json([
        'success'   => true,
        'progress'  => $progress,
        'completed' => $done,
        'total'     => $total,
    ]);
}
}