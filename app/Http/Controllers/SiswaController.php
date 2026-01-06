<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Siswa;
use App\Models\SiswaKelas;
use App\Models\MateriProgress;
use App\Models\Kelas;
use App\Models\Pembayaran; 

class SiswaController extends Controller
{
    public function dashboard()
{
    $user = Auth::user();
    $siswa = Siswa::where('email', $user->email)->first();

    if (!$siswa) {
        return view('siswa.dashboard', [
            'user' => $user,
            'kelasAktif' => 0,
            'kelasAktifList' => collect(),
            'kelasSelesai' => 0,
            'tugasBelumSelesai' => 0,
            'progressRataRata' => 0,
        ]);
    }

    $kelasAktifList = SiswaKelas::with([
            'kelas.guru',
            'kelas.materiPembelajaran'
        ])
        ->where('siswa_id', $siswa->id)
        ->where('status', 'aktif')
        ->get()
        ->map(function ($row) use ($user) {
            $kelas = $row->kelas;
            
            if (!$kelas) {
                return null;
            }

            // ✅ PERBAIKAN: Hitung progress dengan groupBy untuk hindari duplikat
            $totalMateri = $kelas->materiPembelajaran->count();
            
            // Gunakan groupBy untuk ambil materi unik saja
            $completedMateri = MateriProgress::where('user_id', $user->id)
                ->where('kelas_id', $kelas->id)
                ->where('is_completed', true)
                ->select('materi_id')
                ->groupBy('materi_id')
                ->get()
                ->count();
            
            // ✅ Batasi progress maksimal 100%
            $progress = $totalMateri > 0 
                ? min(round(($completedMateri / $totalMateri) * 100), 100) 
                : 0;

            return (object) [
                'id'           => $kelas->id,
                'nama'         => $kelas->nama_kelas,
                'jenjang'      => $kelas->jenjang_pendidikan,
                'guru'         => $kelas->guru,
                'progress'     => $progress,
                'total_materi' => $totalMateri,
                'total_tugas'  => 0,
            ];
        })
        ->filter();

    $kelasAktif = $kelasAktifList->count();
    $kelasSelesai = $kelasAktifList->where('progress', '>=', 100)->count();
    
    // ✅ Batasi progress rata-rata juga
    $progressRataRata = $kelasAktif > 0 
        ? min(round($kelasAktifList->avg('progress')), 100) 
        : 0;
    
    $tugasBelumSelesai = 0;

    return view('siswa.dashboard', [
        'user'              => $user,
        'kelasAktif'        => $kelasAktif,
        'kelasAktifList'    => $kelasAktifList,
        'kelasSelesai'      => $kelasSelesai,
        'tugasBelumSelesai' => $tugasBelumSelesai,
        'progressRataRata'  => $progressRataRata,
    ]);
}

    // ✅ HALAMAN KELAS
    public function kelas()
    {
        $user = Auth::user();

        // Ambil siswa
        $siswa = Siswa::where('email', $user->email)->first();

        if (!$siswa) {
            $kelasList = collect([]);
            return view('siswa.kelas.index', compact('kelasList'));
        }

        // Ambil semua baris pivot siswa_kelas + relasi kelas
        $kelasList = SiswaKelas::with('kelas')
            ->where('siswa_id', $siswa->id)
            ->where('status', 'aktif')
            ->get();

        return view('siswa.kelas.index', compact('kelasList'));
    }

    public function riwayatKelas()
    {
        return view('siswa.kelas.riwayat');
    }

    public function tugas()
    {
        return view('siswa.tugas.index');
    }

    public function pembayaran()
{
    $siswa = auth()->user()->siswa;   

    $pembayaranList = Pembayaran::with(['pemesanan.kelas'])
        ->where('siswa_id', $siswa->id)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('siswa.pembayaran.index', compact('pembayaranList'));
}
public function showPembayaran(Pembayaran $pembayaran)
{
    // opsional: pastikan ini pembayaran milik siswa yang login
    $siswa = auth()->user()->siswa;
    abort_if($pembayaran->siswa_id !== $siswa->id, 403);

    return view('siswa.pembayaran.show', compact('pembayaran'));
}
    
public function storePembayaran(Request $request)
{
    // validasi sederhana contoh
    $request->validate([
        'pembayaran_id'     => 'required|exists:pembayarans,id',
        'bukti_pembayaran'  => 'required|image|max:2048',
    ]);

    // simpan file ke storage/app/public/bukti_pembayaran
    $path = $request->file('bukti_pembayaran')
        ->store('bukti_pembayaran', 'public');

    // ambil record pembayaran yg mau di‑update
    $pembayaran = Pembayaran::findOrFail($request->pembayaran_id);

    // update kolom bukti_pembayaran dengan path file
    $pembayaran->update([
        'bukti_pembayaran' => $path,
    ]);

    return back()->with('success', 'Bukti pembayaran berhasil diupload.');
}

    public function transaksi()
    {
        return view('siswa.transaksi.index');
    }

    public function profil()
    {
        $user = Auth::user();
        return view('siswa.profil.index', compact('user'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Auth::user()->update($request->only(['name']));

        return redirect()->back()->with('success', 'Profil berhasil diupdate');
    }

    public function storeCatatan(Request $request)
    {
        return redirect()->back()->with('success', 'Catatan berhasil disimpan');
    }
}
