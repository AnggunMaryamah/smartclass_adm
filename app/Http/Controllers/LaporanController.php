<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataKelas; 

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tahun_list = DataKelas::select('tahun_ajaran')
                        ->distinct()
                        ->orderBy('tahun_ajaran', 'desc')
                        ->pluck('tahun_ajaran');

        $tahunDipilih = $request->tahun_ajaran;

        $query = DataKelas::query();

        if ($tahunDipilih) {
            $query->where('tahun_ajaran', $tahunDipilih);
        }

        $laporan = $query->orderBy('nama_guru')->get();

        return view('admin.laporan', compact('laporan', 'tahun_list', 'tahunDipilih'));
    }

    public function export(Request $request)
    {
        $tahun = $request->query('tahun_ajaran');

        $query = DataKelas::query();
        if ($tahun) $query->where('tahun_ajaran', $tahun);

        $rows = $query->get();

        $filename = 'laporan_kelas_' . ($tahun ?: 'semua') . '_' . date('Ymd_His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $columns = ['Nama Guru','Nama Kelas','Durasi','Tahun','Status','Siswa Aktif','Jenjang'];

        $callback = function() use ($rows, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($rows as $r) {
                fputcsv($file, [
                    $r->nama_guru,
                    $r->nama_kelas,
                    $r->durasi_pengajaran ?? '-',
                    $r->tahun_ajaran,
                    $r->status_guru ?? '-',
                    $r->siswa_aktif ?? '-',
                    $r->jenjang_pendidikan ?? '-',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}