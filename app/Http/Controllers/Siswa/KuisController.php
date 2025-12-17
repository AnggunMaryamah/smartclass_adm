<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\Tugas;
use App\Models\TugasJawaban;
use App\Models\TugasSoal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KuisController extends Controller
{
    public function index(Kelas $kelas)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->firstOrFail();

        $tugasList = Tugas::where('kelas_id', $kelas->id)
            ->whereIn('tipe', ['kuis', 'ujian', 'ujian_bab'])
            ->where('status', 'active')
            ->orderBy('created_at', 'asc')
            ->get();

        foreach ($tugasList as $tugas) {
            $attempt = TugasJawaban::where('tugas_id', $tugas->id)
                ->where('siswa_id', $siswa->id)
                ->where('status', 'selesai')
                ->first();

            $tugas->sudahDikerjakan = (bool) $attempt;
            $tugas->canRetake = ! $attempt;
        }

        return view('siswa.kuis.index', compact('kelas', 'siswa', 'tugasList'));
    }

    /**
     * Detail kuis (halaman show sebelum mulai)
     */
    public function show(Tugas $tugas)
    {
        $kelas = $tugas->kelas;
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->firstOrFail();

        $totalSoal = $tugas->soals()->count();

        $attempt = TugasJawaban::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'selesai')
            ->first();

        $canRetake = ! $attempt;

        return view('siswa.kuis.show', compact('kelas', 'tugas', 'siswa', 'totalSoal', 'canRetake'));
    }

    /**
     * Mulai kuis (POST) - simpan attempt baru, redirect ke halaman attempt
     */
    public function start(Tugas $tugas)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->firstOrFail();

        $existingAttempt = TugasJawaban::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'pending')
            ->first();

        if (! $existingAttempt) {
            $existingAttempt = TugasJawaban::create([
                'tugas_id' => $tugas->id,
                'siswa_id' => $siswa->id,
                'total_soal' => $tugas->soals()->count(),
                'total_benar' => 0,
                'skor' => 0,
                'status' => 'pending',
            ]);
        }

        // Redirect ke halaman pengerjaan
        return redirect()->route('siswa.kuis.attempt', $tugas->id);
    }

    /**
     * Halaman pengerjaan kuis (GET)
     */
    public function attempt(Tugas $tugas)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->firstOrFail();

        $attempt = TugasJawaban::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'pending')   // ✅ bukan 'ongoing'
            ->firstOrFail();

        $soal = $tugas->soals()->orderBy('created_at')->get();

        $kelas = $tugas->kelas;

        return view('siswa.kuis.attempt', compact('kelas', 'tugas', 'siswa', 'soal', 'attempt'));
    }
public function submit(Request $request, Tugas $tugas)
{
    $user  = Auth::user();
    $siswa = Siswa::where('email', $user->email)->firstOrFail();

    $attempt = TugasJawaban::where('tugas_id', $tugas->id)
        ->where('siswa_id', $siswa->id)
        ->where('status', 'pending')
        ->firstOrFail();

    $jawabanSiswa = $request->input('jawaban', []);
    $totalSoal    = $tugas->soals()->count();
    $benar        = 0;

    foreach ($jawabanSiswa as $soalId => $pilihanSiswa) {
        $soal = TugasSoal::find($soalId);
        if ($soal && $soal->jawaban_benar === $pilihanSiswa) {
            $benar++;
        }
    }

    $skor = $totalSoal > 0 ? round(($benar / $totalSoal) * 100) : 0;

    $attempt->update([
        'total_benar' => $benar,
        'skor'        => $skor,
        'status'      => 'selesai',
    ]);

    // BARIS YANG KAMU TANYA → di sini:
    return redirect()
        ->route('siswa.kuis.result', $tugas->id)
        ->with('success', 'Kuis berhasil diselesaikan!');
}

    /**
     * Hasil kuis (pakai id tugas)
     */
    public function result(Tugas $tugas)
    {
        $user  = Auth::user();
        $siswa = Siswa::where('email', $user->email)->firstOrFail();

        $attempt = TugasJawaban::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'selesai')
            ->latest()
            ->firstOrFail();

        $kelas = $tugas->kelas;

        return view('siswa.kuis.result', compact('kelas', 'tugas', 'siswa', 'attempt'));
    }

    /**
     * Riwayat kuis (opsional)
     */
    public function riwayat(Tugas $tugas)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->firstOrFail();

        $riwayat = TugasJawaban::where('tugas_id', $tugas->id)
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $kelas = $tugas->kelas;

        return view('siswa.kuis.riwayat', compact('kelas', 'tugas', 'siswa', 'riwayat'));
    }
}
