<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TugasJawaban extends Model
{
    protected $table = 'tugas_jawabans';

    // PENTING: primary key integer auto-increment
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'total_soal',
        'total_benar',
        'skor',
        'status',
    ];

    // TIDAK perlu boot() generate UUID, hapus seluruh method boot()

    // Relasi ke Tugas
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    // Relasi ke Detail Jawaban
    public function details()
    {
        return $this->hasMany(TugasJawabanDetail::class, 'tugas_jawaban_id');
    }
}
