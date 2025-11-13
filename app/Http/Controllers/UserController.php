<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // Menampilkan daftar semua pengguna DENGAN FILTER
    public function index(Request $request)
    {
        // Ambil filter dari query string (default: semua)
        $filterRole = $request->query('role', 'semua');
        
        // Query users berdasarkan filter
        if ($filterRole === 'semua') {
            $users = User::all();
        } else {
            // Filter by role (Admin, Guru, Siswa)
            $users = User::where('role', ucfirst($filterRole))->get();
        }
        
        return view('admin.users', compact('users', 'filterRole'));
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
    
    // TAMBAHAN: Hapus user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Simpan nama user untuk message
        $userName = $user->name;
        
        // Hapus user
        $user->delete();
        
        return redirect()->route('admin.users')->with('success', "User $userName berhasil dihapus.");
    }
}
