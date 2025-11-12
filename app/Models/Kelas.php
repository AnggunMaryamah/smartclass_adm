<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Kelas extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'guru_id',
        'nama_kelas',
        'deskripsi',
        'jenjang_pendidikan',
        'harga',
        'durasi', 
        'jadwal_kelas',
        'materi_pembelajaran',
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

    // Relasi dengan Guru
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // Relasi dengan Pemesanan
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    // Relasi dengan Siswa melalui Pemesanan
    public function siswa()
    {
        return $this->hasManyThrough(Siswa::class, Pemesanan::class, 'kelas_id', 'id', 'id', 'siswa_id');
    }
}
