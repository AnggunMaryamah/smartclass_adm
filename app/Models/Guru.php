<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class Guru extends Authenticatable
{
    use HasFactory;

    protected $table = 'gurus';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'admin_id', 'email', 'password', 'nama_lengkap',
        'jenis_kelamin', 'no_hp', 'mata_pelajaran', 'cv', 'status_akun'
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

    public function kelas()
    {
        return $this->hasMany(Kelas::class);
    }

    public function tesKemampuans()
    {
        return $this->hasMany(TesKemampuan::class);
    }
    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
