<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TugasJawabanDetail extends Model
{
    protected $table = 'tugas_jawaban_details';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'tugas_jawaban_id',
        'tugas_soal_id',
        'jawaban_siswa',
        'benar',
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

    // Relasi ke TugasJawaban
    public function tugasJawaban()
    {
        return $this->belongsTo(TugasJawaban::class, 'tugas_jawaban_id');
    }

    // Relasi ke Soal
    public function soal()
    {
        return $this->belongsTo(TugasSoal::class, 'tugas_soal_id');
    }
}
