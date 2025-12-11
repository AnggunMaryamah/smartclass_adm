<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MateriPembelajaran;
use App\Models\Tugas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MateriPembelajaranController extends Controller
{
    /**
     * Display a listing of the materi with pagination
     */
    public function index($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        $materis = MateriPembelajaran::where('kelas_id', $kelasId)
            ->orderBy('bab')
            ->orderBy('urutan')
            ->paginate(10);

        return view('guru.materi_pembelajaran.index', compact('kelas', 'materis'));
    }

    /**
     * Show the form for creating a new materi
     */
    public function create($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);

        // opsi jenis materi yang muncul di dropdown
        $jenisOptions = [
            'bacaan' => 'Materi Bacaan',
            'kuis'   => 'Kuis',
            'ujian'  => 'Ujian',
        ];

        return view('guru.materi_pembelajaran.create', compact('kelas', 'jenisOptions'));
    }

    /**
     * Store a newly created materi in storage
     */
    public function store(Request $request, $kelasId)
    {
        $validated = $request->validate([
            'bab'        => 'required|integer|min:1',
            'urutan'     => 'required|integer|min:1',
            'tipe'       => 'required|in:bacaan,kuis,ujian',
            'judul'      => 'required|string|max:255',
            'konten'     => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_path'  => 'nullable|file|mimes:pdf|max:10240',
            'video_url'  => 'nullable|url',
            'deadline'   => 'nullable|date',
        ]);

        // upload file pdf jika ada
        $pathPdf = null;
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
            $pathPdf = $file->storeAs('materi', $filename, 'public');
        }

        // 1. SELALU simpan materi terlebih dulu (bacaan / kuis / ujian)
        $materi = MateriPembelajaran::create([
            'kelas_id'   => $kelasId,
            'bab'        => $validated['bab'],
            'urutan'     => $validated['urutan'],
            'tipe'       => $validated['tipe'],
            'judul'      => $validated['judul'],
            'konten'     => $validated['konten'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'video_url'  => $validated['video_url'] ?? null,
            'file_path'  => $pathPdf,
            // tugas_id diisi setelah tugas dibuat (untuk kuis/ujian)
        ]);

        // 2. Jika bacaan -> selesai, kembali ke daftar materi
        if ($materi->tipe === 'bacaan') {
            return redirect()
                ->route('guru.materi_pembelajaran.index', $kelasId)
                ->with('success', 'Materi bacaan berhasil ditambahkan');
        }

        // 3. Jika kuis / ujian -> buat tugas yang terhubung dengan materi ini
        $tipeTugas = $materi->tipe === 'kuis' ? 'kuis' : 'ujian_bab';

        $tugas = Tugas::create([
            'kelas_id'  => $kelasId,
            'judul'     => $materi->judul,
            'deskripsi' => $materi->keterangan,
            'deadline'  => $request->input('deadline') ?: null,
            'status'    => 'pending',
            'tipe'      => $tipeTugas,
            // TIDAK ada materi_id di sini (Opsi B)
        ]);

        // 4. simpan id tugas di materi
        $materi->update(['tugas_id' => $tugas->id]);

        // 5. redirect ke kelola soal
        return redirect()
            ->route('guru.tugas.soal.edit', [$kelasId, $tugas->id])
            ->with('success', ucfirst($materi->tipe) . ' berhasil dibuat. Silakan tambahkan soal.');
    }

    /**
     * Show the form for editing the specified materi
     */
    public function edit($kelasId, $materiId)
    {
        $kelas  = Kelas::findOrFail($kelasId);
        $materi = MateriPembelajaran::findOrFail($materiId);

        $jenisOptions = [
            'bacaan' => 'Materi Bacaan',
            'kuis'   => 'Kuis',
            'ujian'  => 'Ujian',
        ];

        return view('guru.materi_pembelajaran.edit', compact('kelas', 'materi', 'jenisOptions'));
    }

    /**
     * Update the specified materi in storage
     */
    public function update(Request $request, $kelasId, $materiId)
    {
        $validated = $request->validate([
            'bab'        => 'required|integer|min:1',
            'urutan'     => 'required|integer|min:1',
            'tipe'       => 'required|in:bacaan,kuis,ujian',
            'judul'      => 'required|string|max:255',
            'konten'     => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_path'  => 'nullable|file|mimes:pdf|max:10240',
            'video_url'  => 'nullable|url',
        ]);

        $materi = MateriPembelajaran::findOrFail($materiId);

        $data = [
            'bab'        => $validated['bab'],
            'urutan'     => $validated['urutan'],
            'tipe'       => $validated['tipe'],
            'judul'      => $validated['judul'],
            'konten'     => $validated['konten'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'video_url'  => $validated['video_url'] ?? null,
        ];

        if ($request->hasFile('file_path')) {
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }

            $file = $request->file('file_path');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
            $data['file_path'] = $file->storeAs('materi', $filename, 'public');
        }

        $materi->update($data);

        return redirect()
            ->route('guru.materi_pembelajaran.index', $kelasId)
            ->with('success', 'Materi berhasil diperbarui');
    }

    /**
     * Remove the specified materi from storage
     */
    public function destroy($kelasId, $materiId)
    {
        $materi = MateriPembelajaran::findOrFail($materiId);

        // Hapus tugas terkait jika ada
        if ($materi->tugas_id) {
            $tugas = Tugas::find($materi->tugas_id);
            if ($tugas) {
                $tugas->delete(); // Akan cascade hapus soal jika ada onDelete cascade
            }
        }

        // Hapus file PDF jika ada
        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }

        $materi->delete();

        return redirect()
            ->route('guru.materi_pembelajaran.index', $kelasId)
            ->with('success', 'Materi berhasil dihapus');
    }
}