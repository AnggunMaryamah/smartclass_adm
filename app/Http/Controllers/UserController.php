<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan daftar semua pengguna
    public function index()
    {
        $users = User::all();
        return view('admin.users', compact('users'));
    }

    // Menampilkan detail pengguna
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show_user', compact('user'));
    }

    // Verifikasi atau nonaktifkan akun
    public function verifikasi($id)
    {
        $user = User::findOrFail($id);

        if ($user->status_akun === 'Belum Aktif') {
            $user->status_akun = 'Aktif';
        } else {
            $user->status_akun = 'Belum Aktif';
        }

        $user->save();

        return redirect()->route('admin.users')->with('success', 'Status akun berhasil diperbarui.');
    }
}