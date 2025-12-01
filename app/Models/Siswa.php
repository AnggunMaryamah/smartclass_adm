<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Siswa extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    
    protected $fillable = [
        'admin_id', 'guru_id', 'nisn', 'nama_lengkap', 'email', 
        'jenis_kelamin', 'jenjang_pendidikan', // ← TAMBAH INI
        'tanggal_lahir', 'alamat', 'nama_orangtua', 
        'email_orangtua', 'no_hp_orangtua', 'status_akun'
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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    // ✅ TAMBAHAN: Relasi many-to-many ke Kelas
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_siswa', 'siswa_id', 'kelas_id')
                    ->withPivot('tanggal_daftar', 'status')
                    ->withTimestamps();
    }

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    public function laporanHasilBelajars()
    {
        return $this->hasMany(LaporanHasilBelajar::class);
    }

    public function tesKemampuans()
    {
        return $this->hasMany(TesKemampuan::class);
    }
}
