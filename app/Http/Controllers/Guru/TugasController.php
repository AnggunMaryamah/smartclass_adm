<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Kelas;
use App\Models\Tugas;
use App\Models\TugasSoal;
use Illuminate\Http\Request;

class TugasController extends Controller
{
    // Daftar semua kuis/ujian di satu kelas
    public function index($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        $tugasList = Tugas::where('kelas_id', $kelasId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('guru.tugas.index', compact('kelas', 'tugasList'));
    }

    // Form buat tugas baru (kuis / ujian)
    public function create($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        // nilai tipe kita batasi ke pilihan enum di migration
        $tipeOptions = [
            'kuis'         => 'Kuis Sub Bab',
            'ujian_subbab' => 'Ujian Sub Bab',
            'ujian_bab'    => 'Ujian Bab',
            'ujian_akhir'  => 'Ujian Akhir',
        ];

        return view('guru.tugas.create', compact('kelas', 'tipeOptions'));
    }

    // Simpan tugas baru
    public function store(Request $request, $kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        $validated = $request->validate([
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline'  => 'nullable|date',
            'tipe'      => 'required|in:kuis,ujian_subbab,ujian_bab,ujian_akhir',
        ]);

        $validated['kelas_id'] = $kelas->id;
        $validated['status']   = 'pending';

        $tugas = Tugas::create($validated);

        return redirect()
            ->route('guru.tugas.soal.edit', [$kelas->id, $tugas->id])
            ->with('success', 'Tugas berhasil dibuat. Silakan tambahkan soal.');
    }

    // Form kelola soal
    public function editSoal($kelasId, Tugas $tugas)
    {
        abort_if($tugas->kelas_id != $kelasId, 404);

        $soals = $tugas->soals()->get();

        return view('guru.tugas.soal', [
            'tugas'   => $tugas,
            'soals'   => $soals,
            'kelasId' => $kelasId,
        ]);
    }

    // Simpan / update daftar soal
    public function storeSoal(Request $request, $kelasId, Tugas $tugas)
    {
        abort_if($tugas->kelas_id != $kelasId, 404);

        $data = $request->validate([
            'soal'                  => 'required|array',
            'soal.*.id'             => 'nullable|integer|exists:tugas_soals,id',
            'soal.*.pertanyaan'     => 'required|string',
            'soal.*.pilihan_a'      => 'required|string',
            'soal.*.pilihan_b'      => 'required|string',
            'soal.*.pilihan_c'      => 'nullable|string',
            'soal.*.pilihan_d'      => 'nullable|string',
            'soal.*.jawaban_benar'  => 'required|in:A,B,C,D',
        ]);

        foreach ($data['soal'] as $item) {
            if (!empty($item['id'])) {
                // update soal lama
                $soal = TugasSoal::where('tugas_id', $tugas->id)
                    ->where('id', $item['id'])
                    ->firstOrFail();

                $soal->update([
                    'pertanyaan'    => $item['pertanyaan'],
                    'pilihan_a'     => $item['pilihan_a'],
                    'pilihan_b'     => $item['pilihan_b'],
                    'pilihan_c'     => $item['pilihan_c'] ?? null,
                    'pilihan_d'     => $item['pilihan_d'] ?? null,
                    'jawaban_benar' => $item['jawaban_benar'],
                ]);
            } else {
                // buat soal baru
                TugasSoal::create([
                    'tugas_id'       => $tugas->id,
                    'pertanyaan'     => $item['pertanyaan'],
                    'pilihan_a'      => $item['pilihan_a'],
                    'pilihan_b'      => $item['pilihan_b'],
                    'pilihan_c'      => $item['pilihan_c'] ?? null,
                    'pilihan_d'      => $item['pilihan_d'] ?? null,
                    'jawaban_benar'  => $item['jawaban_benar'],
                ]);
            }
        }

        return redirect()
            ->route('guru.tugas.index', $kelasId)
            ->with('success', 'Soal berhasil disimpan.');
    }

    // Hapus tugas + semua soal
    public function destroy($kelasId, Tugas $tugas)
    {
        abort_if($tugas->kelas_id != $kelasId, 404);

        $tugas->soals()->delete();
        $tugas->delete();

        return redirect()
            ->route('guru.tugas.index', $kelasId)
            ->with('success', 'Kuis/ujian berhasil dihapus.');
    }
}
