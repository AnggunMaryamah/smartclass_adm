<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Admin extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
    'username',
    'email',
    'password',
    'qris_image',
    'qris_nama_bank',
    'qris_nama_rekening',
    'no_wa',
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

    // Relasi
    public function gurus()
    {
        return $this->hasMany(Guru::class);
    }

    public function siswas()
    {
        return $this->hasMany(Siswa::class);
    }
}
