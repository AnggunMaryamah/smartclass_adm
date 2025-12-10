<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TugasJawaban extends Model
{
    protected $table = 'tugas_jawabans';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'tugas_id',
        'siswa_id',
        'total_soal',
        'total_benar',
        'skor',
        'status',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

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
