<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
