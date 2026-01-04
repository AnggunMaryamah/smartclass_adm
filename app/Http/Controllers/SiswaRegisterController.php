<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaRegisterController extends Controller
{
    /**
     * Tampilkan form daftar siswa
     */
    public function create()
    {
        return view('siswa.daftar');
    }

    /**
     * Simpan data siswa
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
        ]);

        // Cegah daftar ulang
        if (auth()->user()->siswa) {
            return redirect('/siswa/dashboard');
        }

        Siswa::create([
            'user_id' => auth()->id(),
            'nama_lengkap' => $request->nama_lengkap,
        ]);

        return redirect('/siswa/dashboard');
    }
}