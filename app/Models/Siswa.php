<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Siswa extends Model
{
    use HasFactory;

    /**
     * Primary key pakai UUID (string).
     */
    protected $keyType = 'string';
    public $incrementing = false;

    /**
     * Kolom yang boleh di-mass assign.
     */
    protected $fillable = [
        'admin_id',
        'guru_id',
        'nisn',
        'nama_lengkap',
        'email',
        'jenis_kelamin',
        'jenjang_pendidikan',
        'tanggal_lahir',
        'alamat',
        'nama_orangtua',
        'email_orangtua',
        'no_hp_orangtua',
        'status_akun',
    ];

    /**
     * Boot: generate UUID otomatis.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Relasi: Admin.
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    /**
     * Relasi: Guru wali / pembimbing.
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class);
    }

    /**
     * Relasi many-to-many ke Kelas melalui pivot siswa_kelas.
     * Dipakai di whereHas('kelas') di GuruController.
     */
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'siswa_kelas', 'siswa_id', 'kelas_id')
            ->withPivot('progress', 'is_completed', 'status', 'enrolled_at', 'completed_at')
            ->withTimestamps();
    }
    
    /**
     * Relasi: Pemesanan kelas oleh siswa.
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }

    /**
     * Relasi: Laporan hasil belajar.
     */
    public function laporanHasilBelajars()
    {
        return $this->hasMany(LaporanHasilBelajar::class);
    }

    /**
     * Relasi: Tes kemampuan.
     */
    public function tesKemampuans()
    {
        return $this->hasMany(TesKemampuan::class);
    }
}
