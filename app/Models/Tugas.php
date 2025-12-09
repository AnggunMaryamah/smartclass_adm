<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $fillable = [
        'kelas_id',
        'judul',
        'deskripsi',
        'deadline',
        'status',
        'tipe',
    ];
    public function materi()
{
    return $this->hasOne(MateriPembelajaran::class, 'tugas_id');
}

    public function soals()
    {
        return $this->hasMany(TugasSoal::class);
    }

    public function jawabanSiswa()
    {
        return $this->hasMany(TugasJawaban::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
