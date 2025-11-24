<?php

use Illuminate\Database\Seeder;
use App\Models\Jenjang;

class JenjangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['slug'=>'sd','title'=>'SD','description'=>'Program lengkap untuk siswa SD.'],
            ['slug'=>'smp','title'=>'SMP','description'=>'Program lengkap untuk siswa SMP.'],
            ['slug'=>'sma-smk','title'=>'SMA/SMK','description'=>'Program lengkap untuk siswa SMA/SMK.'],
            ['slug'=>'umum','title'=>'Umum','description'=>'Program umum & pengembangan.'],
            ['slug'=>'utbk','title'=>'UTBK','description'=>'Persiapan intensif UTBK.'],
        ];

        foreach ($data as $d) {
            Jenjang::updateOrCreate(['slug'=>$d['slug']], $d);
        }
    }
}
