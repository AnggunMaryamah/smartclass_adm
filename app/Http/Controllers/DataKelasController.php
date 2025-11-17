<?php

namespace App\Http\Controllers;

use App\Models\DataKelas;
use Illuminate\Http\Request;

class DataKelasController extends Controller
{
    public function index(Request $request)
    {
        // Ambil daftar tahun ajaran (unik)
        $tahun_list = DataKelas::select('tahun_ajaran')
                        ->distinct()
                        ->orderBy('tahun_ajaran', 'desc')
                        ->get();

        // Tahun yang dipilih dari dropdown (query string)
        $tahunDipilih = $request->query('tahun_ajaran');

        // Query data
        $query = DataKelas::query();

        if ($tahunDipilih) {
            $query->where('tahun_ajaran', $tahunDipilih);
        }

        $data = $query->get();

        return view('admin.data_kelas', compact('data', 'tahun_list', 'tahunDipilih'));
    }

    // Jika nanti mau toggle status, letakkan method toggleStatus di sini juga:
    public function toggleStatus($id)
    {
        $kelas = DataKelas::findOrFail($id);
        $kelas->status_guru = $kelas->status_guru === 'Aktif' ? 'Tidak Aktif' : 'Aktif';
        $kelas->save();

        return redirect()->route('admin.data_kelas')->with('success', 'Status guru berhasil diubah!');
    }
}