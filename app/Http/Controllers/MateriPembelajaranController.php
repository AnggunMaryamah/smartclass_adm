<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\MateriPembelajaran;
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
        
        // ✅ UBAH dari get() menjadi paginate(10) - 10 data per halaman
        $materis = MateriPembelajaran::where('kelas_id', $kelasId)
            ->orderBy('bab')
            ->orderBy('urutan')
            ->paginate(10); // 10 materi per halaman
        
        return view('guru.materi_pembelajaran.index', compact('kelas', 'materis'));
    }

    /**
     * Show the form for creating a new materi
     */
    public function create($kelasId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        return view('guru.materi_pembelajaran.create', compact('kelas'));
    }

    /**
     * Store a newly created materi in storage
     */
    public function store(Request $request, $kelasId)
    {
        // ✅ VALIDATION
        $validated = $request->validate([
            'bab' => 'required|integer|min:1',
            'urutan' => 'required|integer|min:1',
            'tipe' => 'required|in:bacaan,kuis,ujian',
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
            'video_url' => 'nullable|url',
        ]);

        // ✅ DATA
        $data = [
            'kelas_id' => $kelasId,
            'bab' => $validated['bab'],
            'urutan' => $validated['urutan'],
            'tipe' => $validated['tipe'],
            'judul' => $validated['judul'],
            'konten' => $validated['konten'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
        ];

        // Handle file upload
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
            $data['file_path'] = $file->storeAs('materi', $filename, 'public');
        }

        MateriPembelajaran::create($data);

        return redirect()->route('guru.materi_pembelajaran.index', $kelasId)
                         ->with('success', 'Materi berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified materi
     */
    public function edit($kelasId, $materiId)
    {
        $kelas = Kelas::findOrFail($kelasId);
        $materi = MateriPembelajaran::findOrFail($materiId);
        return view('guru.materi_pembelajaran.edit', compact('kelas', 'materi'));
    }

    /**
     * Update the specified materi in storage
     */
    public function update(Request $request, $kelasId, $materiId)
    {
        // ✅ VALIDATION
        $validated = $request->validate([
            'bab' => 'required|integer|min:1',
            'urutan' => 'required|integer|min:1',
            'tipe' => 'required|in:bacaan,kuis,ujian',
            'judul' => 'required|string|max:255',
            'konten' => 'nullable|string',
            'keterangan' => 'nullable|string',
            'file_path' => 'nullable|file|mimes:pdf|max:10240',
            'video_url' => 'nullable|url',
        ]);

        $materi = MateriPembelajaran::findOrFail($materiId);

        // ✅ DATA
        $data = [
            'bab' => $validated['bab'],
            'urutan' => $validated['urutan'],
            'tipe' => $validated['tipe'],
            'judul' => $validated['judul'],
            'konten' => $validated['konten'] ?? null,
            'keterangan' => $validated['keterangan'] ?? null,
            'video_url' => $validated['video_url'] ?? null,
        ];

        // Handle file upload
        if ($request->hasFile('file_path')) {
            // Delete old file
            if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
                Storage::disk('public')->delete($materi->file_path);
            }
            
            $file = $request->file('file_path');
            $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-\.]/', '_', $file->getClientOriginalName());
            $data['file_path'] = $file->storeAs('materi', $filename, 'public');
        }

        $materi->update($data);

        return redirect()->route('guru.materi_pembelajaran.index', $kelasId)
                         ->with('success', 'Materi berhasil diperbarui');
    }

    /**
     * Remove the specified materi from storage
     */
    public function destroy($kelasId, $materiId)
    {
        $materi = MateriPembelajaran::findOrFail($materiId);
        
        // Delete file if exists
        if ($materi->file_path && Storage::disk('public')->exists($materi->file_path)) {
            Storage::disk('public')->delete($materi->file_path);
        }
        
        $materi->delete();
        
        return redirect()->route('guru.materi_pembelajaran.index', $kelasId)
                         ->with('success', 'Materi berhasil dihapus');
    }
}
