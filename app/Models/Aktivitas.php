<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    use HasFactory;

    protected $table = 'aktivitas';

    protected $fillable = [
        'guru_id',
        'siswa_id',
        'kelas_id',
        'tipe',
        'judul',
        'deskripsi',
        'waktu',
    ];

    protected $casts = [
        'waktu' => 'datetime',
    ];

    // Relasi ke Guru (opsional, kalau mau)
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id', 'id');
    }

    // Relasi ke Siswa (opsional)
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id', 'id');
    }

    // Relasi ke Kelas (opsional)
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
