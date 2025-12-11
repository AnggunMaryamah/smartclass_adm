<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatatanBelajar extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'catatan_belajar';

    protected $fillable = [
        'siswa_id',
        'kelas_id',
        'materi_id',
        'body',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'siswa_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function materi()
    {
        return $this->belongsTo(MateriPembelajaran::class, 'materi_id');
    }
}
