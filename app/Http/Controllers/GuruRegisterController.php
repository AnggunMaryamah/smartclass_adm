<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Admin;
use Illuminate\Support\Str;

class GuruRegisterController extends Controller
{
    public function index()
    {
        return view('guru.index');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'email' => 'required|email|unique:gurus,email',
            'no_hp' => 'required|string|max:20',
            'jenis_kelamin' => 'required|in:L,P',
            'mata_pelajaran' => 'required|string|max:255',
            'cv' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
        ]);

        $admin = Admin::first();
        if (!$admin) {
            return back()->withErrors(['admin' => 'Admin belum tersedia']);
        }

        if ($request->hasFile('cv')) {
            $data['cv'] = $request->file('cv')->store('cv-guru', 'public');
        }

        $data['id'] = (string) Str::uuid();
        $data['admin_id'] = $admin->id;
        $data['password'] = bcrypt(Str::random(10));
        $data['status_akun'] = 'Nonaktif';

        Guru::create($data);

        return redirect()->back()->with('success', 'Pendaftaran berhasil, menunggu verifikasi admin');
    }

}