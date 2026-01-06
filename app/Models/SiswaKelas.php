<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SiswaKelas extends Model
{
    protected $table = 'siswa_kelas';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'progress',
        'is_completed',
        'status',
        'enrolled_at',
        'completed_at',
    ];

    protected $casts = [
        'enrolled_at' => 'datetime',
        'completed_at' => 'datetime',
    ];

    /**
     * ✅ PERBAIKAN: Relasi ke Siswa (BUKAN User)
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    /**
     * Relasi ke Kelas
     */
    /*public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }*/
    public function kelas()
{
    return $this->belongsTo(Kelas::class, 'kelas_id');
}
}
