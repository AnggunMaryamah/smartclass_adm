<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guru;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class GuruSeeder extends Seeder
{
    public function run(): void
    {
        $admin = Admin::first();

        Guru::create([
            'id' => Str::uuid(),
            'admin_id' => $admin->id,
            'email' => 'guru1@smartclass.test',
            'password' => Hash::make('password123'),
            'nama_lengkap' => 'Guru Matematika',
            'jenis_kelamin' => 'L',
            'no_hp' => '081234567890',
            'mata_pelajaran' => 'Matematika',
            'cv' => null,
            'status_akun' => 'Aktif',
        ]);
    }
}