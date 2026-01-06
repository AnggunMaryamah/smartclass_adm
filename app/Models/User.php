<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Guru;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'status_akun',
        'google_id',
        'avatar',
        'qris_image',
        'qris_nama_bank',
        'qris_nama_rekening',
        'no_wa',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->id)) {
                $user->id = (string) Str::uuid();
            }
        });
    }

    // 🔥 REDIRECT FINAL BERDASARKAN ROLE
    public function getRedirectRoute(): string
    {
        return match (strtolower(trim($this->role ?? ''))) {
            'admin' => '/admin/dashboard',
            'guru'  => '/guru/dashboard',
            'siswa' => '/siswa/dashboard',
            default => '/',
        };
    }

    // RELASI SISWA (BENAR, PAKAI user_id)
    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    // 🔥 RELASI GURU FINAL (PAKAI EMAIL)
    public function guru(): HasOne
    {
        return $this->hasOne(
            Guru::class,
            'email', // kolom di tabel gurus
            'email'  // kolom di tabel users
        );
    }

    // HELPER ADMIN
    public function isAdmin(): bool
    {
        return strtolower(trim($this->role ?? '')) === 'admin';
    }
}