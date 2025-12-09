<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasJawabanDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_jawaban_id',
        'tugas_soal_id',
        'jawaban_siswa',
        'benar',
    ];

    public function jawaban()
    {
        return $this->belongsTo(TugasJawaban::class, 'tugas_jawaban_id');
    }

    public function soal()
    {
        return $this->belongsTo(TugasSoal::class, 'tugas_soal_id');
    }
}
