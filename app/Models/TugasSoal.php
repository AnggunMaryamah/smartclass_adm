<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasSoal extends Model
{
    use HasFactory;

    protected $fillable = [
        'tugas_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'jawaban_benar',
    ];

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}
