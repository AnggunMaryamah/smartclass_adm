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

    /**
     * UUID (bukan auto increment)
     */
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'role',
        'status_akun',

        // OAuth / profile
        'google_id',
        'avatar',

        // QRIS
        'qris_image',
        'qris_nama_bank',
        'qris_nama_rekening',
        'no_wa',

        'email_verified_at',
    ];

    /**
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Auto-generate UUID when creating
     */
    protected static function booted()
    {
        static::creating(function ($user) {
            if (empty($user->id)) {
                $user->id = (string) Str::uuid();
            }
        });
    }

    /**
     * Redirect after login based on role
     */
    public function getRedirectRoute(): string
    {
        return match (strtolower($this->role ?? '')) {
            'admin' => '/admin/dashboard',
            'guru'  => '/guru/dashboard',
            'siswa' => '/siswa/dashboard',
            default => '/dashboard',
        };
    }

    /**
     * Relasi ke siswa_kelas
     */
    public function siswaKelas(): HasMany
    {
        return $this->hasMany(SiswaKelas::class, 'siswa_id');
    }

    /**
     * Relasi one-to-one ke tabel siswa
     */
    public function siswa(): HasOne
    {
        return $this->hasOne(Siswa::class, 'user_id', 'id');
    }

    /**
     * Helper role
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
