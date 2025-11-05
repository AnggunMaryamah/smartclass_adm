<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Guru;
use Illuminate\Support\Str;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $guru = Guru::first();

        Kelas::create([
            'id' => Str::uuid(),
            'guru_id' => $guru->id,
            'nama_kelas' => 'Kelas 7A',
            'deskripsi' => 'Kelas matematika untuk tingkat SMP.',
            'jenjang_pendidikan' => 'SMP',
            'harga' => 250000,
            'durasi' => '1 bulan',
            'jadwal_kelas' => 'Senin & Rabu pukul 10.00',
            'materi_pembelajaran' => 'Dasar-dasar aljabar dan geometri.',
        ]);
    }
}
