<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MateriPembelajaran;
use App\Models\MateriProgress;
use App\Models\Siswa;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SiswaKelasController extends Controller
{
    /**
     * Tambahkan siswa ke kelas
     */
    public function tambahSiswaKeKelas(Request $request)
    {
        $request->validate([
            'siswa_id' => 'required|exists:siswas,id',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $siswa = Siswa::findOrFail($request->siswa_id);
        $kelas = Kelas::findOrFail($request->kelas_id);

        if ($siswa->jenjang_pendidikan && $siswa->jenjang_pendidikan !== $kelas->jenjang_pendidikan) {
            return back()->with('error', 'Jenjang pendidikan siswa tidak sesuai.');
        }

        if ($siswa->kelas()->where('kelas_id', $kelas->id)->exists()) {
            return back()->with('error', 'Siswa sudah terdaftar di kelas ini.');
        }

        $siswa->kelas()->attach($kelas->id, [
            'tanggal_daftar' => now(),
            'status'         => 'aktif',
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

        $kelas->increment('jumlah_siswa');

        return back()->with('success', 'Siswa berhasil ditambahkan ke kelas.');
    }

    /**
     * Hapus siswa dari kelas
     */
    public function hapusSiswaDariKelas($kelasId, $siswaId)
    {
        $siswa = Siswa::findOrFail($siswaId);
        $kelas = Kelas::findOrFail($kelasId);

        $siswa->kelas()->detach($kelasId);
        $kelas->decrement('jumlah_siswa');

        return back()->with('success', 'Siswa berhasil dihapus dari kelas.');
    }

    /**
     * Halaman baca materi siswa
     */
    public function read(Kelas $kelas, ?MateriPembelajaran $materi = null)
    {
        $userId = Auth::id();

        // >>> HANYA AMBIL MATERI BACAAN UNTUK SIDEBAR <<<
        $materiList = MateriPembelajaran::where('kelas_id', $kelas->id)
            ->where('tipe', 'bacaan')              // PERUBAHAN PENTING
            ->orderBy('urutan', 'asc')
            ->get();

        // kalau tidak ada materi bacaan sama sekali, langsung lempar ke view kosong
        if ($materiList->isEmpty()) {
            return view('siswa.kelas.read', [
                'kelas'               => $kelas,
                'materi'              => null,
                'currentMateri'       => null,
                'materiList'          => $materiList,
                'groupedMateri'       => collect(),
                'completionPercentage'=> 0,
                'materiProgress'      => [],
                'completedMateriIds'  => [],
                'prevMateri'          => null,
                'nextMateri'          => null,
            ]);
        }

        $completionPercentage = MateriPembelajaran::getCompletionPercentage($kelas->id, $userId);

        $materiProgress = MateriProgress::where('user_id', $userId)
            ->where('kelas_id', $kelas->id)
            ->pluck('is_completed', 'materi_id')
            ->toArray();

        $completedMateriIds = array_keys(
            array_filter($materiProgress, fn ($val) => (bool) $val === true)
        );

        // materi aktif (kalau parameter $materi bukan bacaan, fallback ke pertama)
        $currentMateri = $materi && $materi->tipe === 'bacaan'
            ? $materi
            : $materiList->first();

        // cari index materi aktif
        $currentIndex = $materiList->search(function ($m) use ($currentMateri) {
            return $currentMateri && $m->id === $currentMateri->id;
        });

        // materi sebelumnya & berikutnya
        $prevMateri = null;
        $nextMateri = null;

        if ($currentIndex !== false) {
            if ($currentIndex > 0) {
                $prevMateri = $materiList[$currentIndex - 1];
            }
            if ($currentIndex < $materiList->count() - 1) {
                $nextMateri = $materiList[$currentIndex + 1];
            }
        }

        return view('siswa.kelas.read', [
            'kelas'               => $kelas,
            'materi'              => $currentMateri,
            'currentMateri'       => $currentMateri,
            'materiList'          => $materiList,
            'groupedMateri'       => $materiList->groupBy('bab'),
            'completionPercentage'=> $completionPercentage,
            'materiProgress'      => $materiProgress,
            'completedMateriIds'  => $completedMateriIds,
            'prevMateri'          => $prevMateri,
            'nextMateri'          => $nextMateri,
        ]);
    }

    /**
     * Tandai materi selesai
     */
    public function markComplete(Kelas $kelas, MateriPembelajaran $materi)
    {
        $user = Auth::user();

        // hanya izinkan tandai selesai untuk materi bacaan
        if ($materi->tipe !== 'bacaan') {
            return response()->json([
                'success'  => false,
                'message'  => 'Hanya materi bacaan yang bisa ditandai selesai.',
            ], 400);
        }

        MateriProgress::updateOrCreate(
            [
                'user_id'   => $user->id,
                'kelas_id'  => $kelas->id,
                'materi_id' => $materi->id,
            ],
            [
                'is_completed' => true,
                'completed_at' => now(),
                'last_read_at' => now(),
            ]
        );

        // >>> PROGRESS HANYA HITUNG BACAAN <<<
        $total = MateriPembelajaran::where('kelas_id', $kelas->id)
            ->where('tipe', 'bacaan')
            ->count();

        $done = MateriProgress::where('user_id', $user->id)
            ->where('kelas_id', $kelas->id)
            ->where('is_completed', true)
            ->whereHas('materi', function ($q) use ($kelas) {
                $q->where('kelas_id', $kelas->id)
                  ->where('tipe', 'bacaan');
            })
            ->select('materi_id')
            ->groupBy('materi_id')
            ->get()
            ->count();

        $progress = $total > 0 ? min(round(($done / $total) * 100), 100) : 0;

        return response()->json([
            'success'   => true,
            'progress'  => $progress,
            'completed' => $done,
            'total'     => $total,
        ]);
    }

    /**
     * Batalkan selesai
     */
    public function markUncomplete(Kelas $kelas, MateriPembelajaran $materi)
    {
        $user = Auth::user();

        MateriProgress::where('user_id', $user->id)
            ->where('kelas_id', $kelas->id)
            ->where('materi_id', $materi->id)
            ->update([
                'is_completed' => false,
                'completed_at' => null,
            ]);

        return response()->json(['success' => true]);
    }

    /**
     * Daftar kuis & ujian
     */
    public function daftarKuis(Kelas $kelas)
    {
        $user  = Auth::user();
        $siswa = Siswa::where('email', $user->email)->firstOrFail();

        $kuisDanUjian = Tugas::where('kelas_id', $kelas->id)
            ->whereIn('tipe', ['kuis', 'ujian', 'ujian_bab'])
            ->where('status', 'active')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('siswa.kuis.index', compact(
            'kelas',
            'siswa',
            'kuisDanUjian'
        ));
    }
}
