<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function storeKelas(Request $request)
    {
        try {
            $validated = $request->validate([
                'nama_kelas' => 'required|string|max:255',
                'jenjang_pendidikan' => 'required|in:SD,SMP,SMA',
                'harga' => 'required|numeric|min:0',
                'durasi' => 'required|string',
                'durasi_custom' => 'nullable|string',
                'deskripsi' => 'nullable|string',
            ]);

            $durasi_final = $validated['durasi'];
            if ($validated['durasi'] === 'custom' && !empty($request->durasi_custom)) {
                $durasi_final = $request->durasi_custom;
            }

            // HARDCODE GURU ID SEMENTARA (ganti dengan ID guru yang ada di database)
            $guruId = '642b715f-b867-4fe3-9d45-8ebf2e4cc2f2'; // Sesuaikan dengan ID guru di database

            $kelas = Kelas::create([
                'guru_id' => $guruId, // Hardcode sementara
                'nama_kelas' => $validated['nama_kelas'],
                'jenjang_pendidikan' => $validated['jenjang_pendidikan'],
                'harga' => $validated['harga'],
                'durasi' => $durasi_final,
                'deskripsi' => $validated['deskripsi'],
                'status' => 'aktif',
                'jumlah_siswa' => 0,
            ]);

            return redirect()
                ->route('guru.kelas.index')
                ->with('success', 'Kelas berhasil ditambahkan!');

        } catch (\Exception $e) {
            \Log::error('Error creating kelas: ' . $e->getMessage());

            return redirect()
                ->back()
                ->withInput()
                ->with('error', 'Gagal menyimpan kelas: ' . $e->getMessage());
        }
    }
    public function publicByJenjang($jenjang)
    {
        // normalisasi / validasi input
        $allowed = ['SD', 'SMP', 'SMA'];
        $upper = strtoupper($jenjang);

        if (!in_array($upper, $allowed)) {
            abort(404);
        }

        // ambil kelas jenjang tersebut; pastikan nilai string dikasih dengan quotes (di Eloquent ini otomatis)
        $kelas = \App\Models\Kelas::where('jenjang_pendidikan', $upper)
            // kalau kolom status ada, pakai string 'aktif' (dengan quotes)
            ->where('status', 'aktif')
            ->orderBy('created_at', 'desc')
            ->get();

        // pilih view berdasarkan jenjang: resources/views/sd/index.blade.php dsb.
        $viewName = strtolower($upper) . '.index'; // 'sd.index', 'smp.index', 'sma.index'

        if (!view()->exists($viewName)) {
            // fallback: pakai satu view generik di resources/views/jenjang/index.blade.php
            $viewName = 'jenjang.index';
        }

        return view($viewName, compact('kelas'));
    }

}