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

    // UUID (bukan auto increment)
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Mass assignable attributes
     */
    protected $fillable = [
<<<<<<< HEAD
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'avatar',
        'email_verified_at',
    ];
=======
    'id',
    'name',
    'email',
    'password',
    'role',
    'status_akun',

    // QRIS
    'qris_image',
    'qris_nama_bank',
    'qris_nama_rekening',
    'no_wa',
];


    /**
     * Hidden attributes
     */
>>>>>>> 340ac98 (ini admin.pembayaran)
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Attribute casting
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Auto-generate UUID when creating
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
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
            'guru' => '/guru/dashboard',
            'siswa' => '/siswa/dashboard',
            default => '/dashboard',
        };
    }

    /**
     * Relasi ke siswa_kelas (jika digunakan)
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
}
