<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MateriPembelajaran extends Model
{
    protected $table = 'materi_pembelajaran';

    protected $fillable = [
        'kelas_id', 'bab', 'judul', 'keterangan', 'tipe', 'konten', 'file_path', 'urutan', 'tugas_id', 'video_url'];

    protected $casts = [
        'bab' => 'integer',
        'urutan' => 'integer',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'id');
    }

    // Relasi ke Tugas (Kuis/Ujian)
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'materi_id')
            ->where('status', 'active')
            ->orderBy('created_at', 'asc');
    }

    // Relasi ke Kuis (filter tipe)
    public function kuis()
    {
        return $this->hasMany(Tugas::class, 'materi_id')->where('tipe', 'kuis');
    }

    // Relasi ke Ujian (filter tipe)
    public function ujian()
    {
        return $this->hasMany(Tugas::class, 'materi_id')->whereIn('tipe', ['ujian', 'ujian_bab']);
    }

    public function progress()
    {
        return $this->hasMany(MateriProgress::class, 'materi_id');
    }

    /**
     * Check apakah materi sudah diselesaikan oleh siswa tertentu
     */
    public function isCompletedBy($userId)
    {
        return $this->progress()
            ->where('user_id', $userId)
            ->where('is_completed', true)
            ->exists();
    }

    public static function getCompletionPercentage(string $kelasId, string $userId): int
    {
        // hitung semua baris materi di kelas ini (tidak filter tipe)
        $total = self::where('kelas_id', $kelasId)->count();

        if ($total === 0) {
            return 0;
        }

        // hitung materi yang sudah completed
        $done = \App\Models\MateriProgress::where('user_id', $userId)
            ->where('kelas_id', $kelasId)
            ->where('is_completed', true)
            ->select('materi_id')
            ->groupBy('materi_id')
            ->get()
            ->count();

        return min((int) round(($done / $total) * 100), 100);
    }
}
