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

    public function store(Request $request, $kelasId)
{
    $kelas = Kelas::findOrFail($kelasId);

    $validated = $request->validate([
        'judul'     => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'deadline'  => 'nullable|date',
        'tipe'      => 'required|in:kuis,ujian_subbab,ujian_bab,ujian_akhir',
    ]);

    // 1. BUAT TUGAS DULU
    $tugas = Tugas::create([
        'kelas_id'  => $kelas->id,
        'judul'     => $validated['judul'],
        'deskripsi' => $validated['deskripsi'],
        'deadline'  => $validated['deadline'],
        'status'    => 'pending',
        'tipe'      => $validated['tipe'],
    ]);

    // 2. BUAT RECORD DI MATERI_PEMBELAJARAN (AGAR MUNCUL DI DAFTAR MATERI)
    \App\Models\MateriPembelajaran::create([
        'kelas_id'   => $kelas->id,
        'bab'        => 0, // Default 0 untuk kuis/ujian, bisa diubah nanti
        'urutan'     => 999, // Prioritas rendah agar muncul di bawah
        'tipe'       => $validated['tipe'] === 'kuis' ? 'kuis' : 'ujian',
        'judul'      => $validated['judul'],
        'keterangan' => $validated['deskripsi'],
        'tugas_id'   => $tugas->id, // LINK KE TUGAS
    ]);

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

        // PERBAIKAN: Validasi id sekarang string UUID, bukan integer
        $data = $request->validate([
            'soal'                  => 'required|array',
            'soal.*.id'             => 'nullable|string|size:36', // UUID 36 karakter
            'soal.*.pertanyaan'     => 'required|string',
            'soal.*.pilihan_a'      => 'required|string',
            'soal.*.pilihan_b'      => 'required|string',
            'soal.*.pilihan_c'      => 'nullable|string',
            'soal.*.pilihan_d'      => 'nullable|string',
            'soal.*.jawaban_benar'  => 'required|in:A,B,C,D',
        ]);

        foreach ($data['soal'] as $item) {
            // PERBAIKAN: Cek id valid UUID (36 karakter) dan tidak kosong
            if (!empty($item['id']) && strlen($item['id']) === 36) {
                // Update soal existing
                TugasSoal::where('id', $item['id'])
                    ->where('tugas_id', $tugas->id)
                    ->update([
                        'pertanyaan'    => $item['pertanyaan'],
                        'pilihan_a'     => $item['pilihan_a'],
                        'pilihan_b'     => $item['pilihan_b'],
                        'pilihan_c'     => $item['pilihan_c'] ?? null,
                        'pilihan_d'     => $item['pilihan_d'] ?? null,
                        'jawaban_benar' => $item['jawaban_benar'],
                    ]);
            } else {
                // PERBAIKAN: Buat soal baru TANPA field 'id'
                // Model TugasSoal akan auto-generate UUID di method boot()
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

   public function destroy($kelasId, Tugas $tugas)
{
    abort_if($tugas->kelas_id != $kelasId, 404);

    // 1. Hapus record di materi_pembelajaran yang terhubung dengan tugas ini
    \App\Models\MateriPembelajaran::where('tugas_id', $tugas->id)->delete();

    // 2. Hapus semua soal
    $tugas->soals()->delete();
    
    // 3. Hapus tugas
    $tugas->delete();

    return redirect()
        ->route('guru.tugas.index', $kelasId)
        ->with('success', 'Kuis/ujian berhasil dihapus.');
}
    // Publish tugas agar siswa bisa akses
public function publish($kelasId, Tugas $tugas)
{
    abort_if($tugas->kelas_id != $kelasId, 404);

    // Validasi: minimal 1 soal
    if ($tugas->soals()->count() < 1) {
        return redirect()
            ->back()
            ->with('error', 'Kuis harus memiliki minimal 1 soal sebelum dipublish!');
    }

    $tugas->update(['status' => 'active']);

    return redirect()
        ->back()
        ->with('success', 'Kuis berhasil dipublish! Siswa sekarang bisa mengerjakan.');
}

// Unpublish tugas (sembunyikan dari siswa)
public function unpublish($kelasId, Tugas $tugas)
{
    abort_if($tugas->kelas_id != $kelasId, 404);

    $tugas->update(['status' => 'pending']);

    return redirect()
        ->back()
        ->with('success', 'Kuis belum bisa dilihat siswa.');
}
}