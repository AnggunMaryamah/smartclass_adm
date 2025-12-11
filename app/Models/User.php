<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Karena pakai UUID, bukan auto-increment
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'avatar',
        'email_verified_at',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Auto-generate UUID saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }

    public function getRedirectRoute()
    {
        $role = strtolower($this->role ?? '');

        return match ($role) {
            'admin' => '/admin/dashboard',
            'guru' => '/guru/dashboard',
            'siswa' => '/siswa/dashboard',
            default => '/dashboard',
        };
    }

    // Relasi ke tabel pivot siswa_kelas (kalau memang user_id dipakai di sana)
    public function siswaKelas(): HasMany
    {
        return $this->hasMany(SiswaKelas::class, 'siswa_id');
    }

    // ✅ Relasi One-to-One ke Siswa
    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }
}