<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class LaporanHasilBelajar extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
    'siswa_id',
    'jenis_penilaian',
    'materi_pembelajaran',
    'nilai',
    'predikat',
    'capaian_kompetensi',
    'catatan_guru',
    'status_laporan'
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

    // Relasi dengan Siswa
    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
