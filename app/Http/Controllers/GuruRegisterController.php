<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Admin; // 🔥 BUKAN User
use Illuminate\Support\Facades\Hash;

class GuruRegisterController extends Controller
{
    public function form()
    {
        return view('guru.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap'   => 'required|string|max:255',
            'email'          => 'required|email',
            'no_hp'          => 'required|string',
            'jenis_kelamin'  => 'required|in:L,P',
            'mata_pelajaran' => 'required|string',
            'cv'             => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        // 🔥 AMBIL ADMIN DARI TABEL ADMINS (WAJIB)
        $adminId = Admin::value('id'); // ambil admin pertama

        if (!$adminId) {
            return back()->withErrors([
                'admin' => 'Data admin belum tersedia'
            ]);
        }

        Guru::create([
            'admin_id'       => $adminId, // ✅ SESUAI FOREIGN KEY
            'nama_lengkap'   => $request->nama_lengkap,
            'email'          => $request->email,
            'password'       => Hash::make('guru12345'),
            'no_hp'          => $request->no_hp,
            'jenis_kelamin'  => $request->jenis_kelamin,
            'mata_pelajaran' => $request->mata_pelajaran,
            'status_akun'    => 'Nonaktif',
        ]);

        return redirect()->route('guru.form')
            ->with('success', 'Pendaftaran berhasil, menunggu verifikasi admin.');
    }
}