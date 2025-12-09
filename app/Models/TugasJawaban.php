<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasJawaban extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'total_soal',
        'total_benar',
        'skor',
        'status',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }

    public function details()
    {
        return $this->hasMany(TugasJawabanDetail::class);
    }
}
