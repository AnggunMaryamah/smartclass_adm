<?php

namespace App\Http\Middleware;

use App\Models\MateriPembelajaran;
use App\Models\Tugas;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckMateriCompletion
{
    public function handle(Request $request, Closure $next)
    {
        // Ambil ID tugas dari route
        $tugasId = $request->route('tugas');

        // Jika pakai route model binding, $tugasId bisa sudah berupa instance Tugas
        if ($tugasId instanceof Tugas) {
            $tugas = $tugasId;
        } else {
            // Jika masih berupa string, ambil dari database
            $tugas = Tugas::find($tugasId);
        }

        if (!$tugas) {
            return redirect()->back()->with('error', 'Tugas tidak ditemukan.');
        }

        $userId  = Auth::id();
        $kelasId = $tugas->kelas_id;

        // Hitung completion percentage
        $completionPercentage = MateriPembelajaran::getCompletionPercentage($kelasId, $userId);

        // Validasi minimal 100% materi selesai
        if ($completionPercentage < 100) {
            return redirect()
                ->route('siswa.kelas.read.index', ['kelas' => $kelasId])
                ->with(
                    'error',
                    "Anda harus menyelesaikan 100% materi sebelum mengerjakan {$tugas->tipe}. " .
                    "Progress saat ini: {$completionPercentage}%"
                );
        }

        // Lolos cek, lanjut ke controller
        return $next($request);
    }
}
