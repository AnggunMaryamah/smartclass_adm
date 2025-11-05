<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Siswa;
use App\Models\Admin;
use App\Models\Guru;
use Illuminate\Support\Str;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::first();
        $guru = Guru::first();

        Siswa::create([
            'id' => Str::uuid(),
            'admin_id' => $admin->id,
            'guru_id' => $guru->id,
            'nisn' => '1234567890',
            'nama_lengkap' => 'Siswa Pertama',
            'email' => 'siswa1@smartclass.test',
            'jenis_kelamin' => 'L',
            'tanggal_lahir' => '2010-05-01',
            'alamat' => 'Jl. Belajar No. 1',
            'nama_orangtua' => 'Budi Santoso',
            'email_orangtua' => 'ortu1@smartclass.test',
            'status_akun' => 'Aktif',
        ]);
    }
}
