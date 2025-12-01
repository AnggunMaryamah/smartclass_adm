<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriPembelajaran extends Model
{
    protected $table = 'materi_pembelajaran';

    protected $fillable = [
        'kelas_id', 'bab', 'judul', 'keterangan', 'tipe', 'konten', 'file_path', 'urutan'
    ];
    protected $casts = [
        'bab' => 'integer',
        'urutan' => 'integer',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }
}
