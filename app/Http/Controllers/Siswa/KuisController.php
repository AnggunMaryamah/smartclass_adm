<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\TugasJawaban;
use App\Models\TugasJawabanDetail;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class KuisController extends Controller
{
    /**
     * Tampilkan halaman kuis/ujian (sebelum mulai)
     */
    public function show($tugasId)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $tugas = Tugas::with(['kelas', 'materi', 'soal'])->findOrFail($tugasId);

        // Cek apakah siswa sudah pernah mengerjakan
        $riwayat = TugasJawaban::where('tugas_id', $tugasId)
            ->where('siswa_id', $siswa->id)
            ->orderBy('created_at', 'desc')
            ->get();

        // Cek apakah ada attempt yang sedang berjalan
        $currentAttempt = TugasJawaban::where('tugas_id', $tugasId)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'pending')
            ->first();

        return view('siswa.kuis.show', [
            'tugas' => $tugas,
            'siswa' => $siswa,
            'riwayat' => $riwayat,
            'currentAttempt' => $currentAttempt,
            'totalSoal' => $tugas->soal->count(),
        ]);
    }

    /**
     * Mulai kuis/ujian (create attempt baru)
     */
    public function start($tugasId)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $tugas = Tugas::with('soal')->findOrFail($tugasId);

        // Cek apakah masih ada attempt yang pending
        $pendingAttempt = TugasJawaban::where('tugas_id', $tugasId)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'pending')
            ->first();

        if ($pendingAttempt) {
            // Lanjutkan attempt yang pending
            return redirect()->route('siswa.kuis.attempt', $pendingAttempt->id);
        }

        // Buat attempt baru
        $attempt = TugasJawaban::create([
            'tugas_id' => $tugasId,
            'siswa_id' => $siswa->id,
            'total_soal' => $tugas->soal->count(),
            'total_benar' => 0,
            'skor' => 0,
            'status' => 'pending',
        ]);

        return redirect()->route('siswa.kuis.attempt', $attempt->id);
    }

    /**
     * Halaman mengerjakan kuis (dengan soal dan timer)
     */
    public function attempt($attemptId)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $attempt = TugasJawaban::with(['tugas.soal', 'tugas.kelas', 'details'])
            ->findOrFail($attemptId);

        // Pastikan attempt ini milik siswa yang login
        if ($attempt->siswa_id !== $siswa->id) {
            abort(403, 'Unauthorized');
        }

        // Jika sudah selesai, redirect ke hasil
        if ($attempt->status === 'selesai') {
            return redirect()->route('siswa.kuis.result', $attemptId);
        }

        $tugas = $attempt->tugas;
        $soal = $tugas->soal;

        // Ambil jawaban yang sudah disimpan (jika ada)
        $savedAnswers = $attempt->details->pluck('jawaban_siswa', 'tugas_soal_id')->toArray();

        return view('siswa.kuis.attempt', [
            'attempt' => $attempt,
            'tugas' => $tugas,
            'soal' => $soal,
            'savedAnswers' => $savedAnswers,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Submit jawaban kuis/ujian
     */
    public function submit(Request $request, $attemptId)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return response()->json(['error' => 'Data siswa tidak ditemukan'], 403);
        }

        $attempt = TugasJawaban::with(['tugas.soal'])->findOrFail($attemptId);

        // Pastikan attempt ini milik siswa yang login
        if ($attempt->siswa_id !== $siswa->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        // Pastikan attempt masih pending
        if ($attempt->status === 'selesai') {
            return response()->json(['error' => 'Kuis sudah selesai dikerjakan'], 400);
        }

        $tugas = $attempt->tugas;
        $soal = $tugas->soal;
        $jawaban = $request->input('jawaban', []); // Format: ['soal_id' => 'A', ...]

        DB::beginTransaction();
        try {
            $totalBenar = 0;

            // Hapus jawaban lama (jika ada)
            TugasJawabanDetail::where('tugas_jawaban_id', $attemptId)->delete();

            // Simpan jawaban baru
            foreach ($soal as $soalItem) {
                $jawabanSiswa = $jawaban[$soalItem->id] ?? null;
                $isBenar = ($jawabanSiswa === $soalItem->jawaban_benar);

                if ($isBenar) {
                    $totalBenar++;
                }

                TugasJawabanDetail::create([
                    'tugas_jawaban_id' => $attemptId,
                    'tugas_soal_id' => $soalItem->id,
                    'jawaban_siswa' => $jawabanSiswa,
                    'benar' => $isBenar ? 1 : 0,
                ]);
            }

            // Hitung skor
            $totalSoal = $soal->count();
            $skor = $totalSoal > 0 ? round(($totalBenar / $totalSoal) * 100) : 0;

            // Update attempt
            $attempt->update([
                'total_benar' => $totalBenar,
                'skor' => $skor,
                'status' => 'selesai',
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Jawaban berhasil disimpan',
                'redirect' => route('siswa.kuis.result', $attemptId),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['error' => 'Terjadi kesalahan: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Tampilkan hasil kuis/ujian
     */
    public function result($attemptId)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $attempt = TugasJawaban::with([
            'tugas.soal',
            'tugas.kelas',
            'details.soal'
        ])->findOrFail($attemptId);

        // Pastikan attempt ini milik siswa yang login
        if ($attempt->siswa_id !== $siswa->id) {
            abort(403, 'Unauthorized');
        }

        return view('siswa.kuis.result', [
            'attempt' => $attempt,
            'tugas' => $attempt->tugas,
            'siswa' => $siswa,
        ]);
    }

    /**
     * Riwayat pengerjaan kuis
     */
    public function riwayat($tugasId)
    {
        $user = Auth::user();
        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            return redirect()->route('siswa.dashboard')->with('error', 'Data siswa tidak ditemukan');
        }

        $tugas = Tugas::findOrFail($tugasId);

        $riwayat = TugasJawaban::where('tugas_id', $tugasId)
            ->where('siswa_id', $siswa->id)
            ->where('status', 'selesai')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.kuis.riwayat', [
            'tugas' => $tugas,
            'riwayat' => $riwayat,
            'siswa' => $siswa,
        ]);
    }
}
