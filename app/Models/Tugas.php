<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tugas extends Model
{
    protected $table = 'tugas';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'kelas_id',
        'materi_id',
        'judul',
        'deskripsi',
        'deadline',
        'status',
        'tipe',
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

    // Relasi ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    // Relasi ke Materi
    public function materi()
    {
        return $this->belongsTo(MateriPembelajaran::class, 'materi_id');
    }

    // Relasi ke Soal
    public function soals()
    {
        return $this->hasMany(TugasSoal::class, 'tugas_id');
    }

    // Relasi ke Jawaban Siswa
    public function jawabans()
    {
        return $this->hasMany(TugasJawaban::class, 'tugas_id');
    }
}
