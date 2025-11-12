<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataKelas extends Model
{
    use HasFactory;

    protected $table = 'data_kelas'; // sesuaikan dengan nama tabel di database
    protected $fillable = [
        'nama_guru',
        'nama_kelas',
        'durasi_pengajaran',
        'tahun_ajaran',
        'status_guru',
    ];
}