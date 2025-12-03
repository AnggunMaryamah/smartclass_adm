<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = DB::table('admins')->where('id', 'ADM001')->first();

        if ($admin) {
            User::create([
                'name' => $admin->username,
                'email' => $admin->email,              // contoh: admin@smartclass.test
                'password' => Hash::make('admin123'), // <─ password plain yang kamu mau
                'role' => 'admin',
                'status_akun' => 'aktif',
            ]);
        }

        // Guru
        $guru = DB::table('gurus')->where('admin_id', 'ADM001')->first();

        if ($guru) {
            User::create([
                'name' => $guru->nama_lengkap,
                'email' => $guru->email,              // contoh: guru1@smartclass.test
                'password' => Hash::make('guru123'),  // password login guru
                'role' => 'guru',
                'status_akun' => 'aktif',
            ]);
        }

        // Siswa
        $siswa = DB::table('siswas')->where('admin_id', 'ADM001')->first();

        if ($siswa) {
            User::create([
                'name' => $siswa->nama_lengkap,
                'email' => $siswa->email,
                'password' => Hash::make('siswa123'), // password login siswa
                'role' => 'siswa',
                'status_akun' => 'aktif',
            ]);
        }
    }
}