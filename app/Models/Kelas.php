<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;   // ⬅️ ini yang benar
use Illuminate\Support\Str;
use App\Models\Materi;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kelas';

    /**
     * Tipe primary key (UUID string).
     */
    protected $keyType = 'string';

    /**
     * ID tidak auto-increment.
     */
    public $incrementing = false;

    /**
     * Kolom yang bisa diisi mass-assignment.
     */
    protected $fillable = [
    'guru_id',
    'nama_kelas',
    'deskripsi',
    'jenjang_pendidikan',
    'harga',
    'durasi',
    'jumlah_siswa',
    'status',
];

    /**
     * Casting atribut.
     */
    protected $casts = [
        'harga' => 'integer',
        'jumlah_siswa' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Boot: generate UUID untuk primary key.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        // Aktifkan lagi jika sudah butuh auto-update jumlah_siswa
        // static::saved(function ($model) {
        //     $model->updateJumlahSiswa();
        // });
    }

    /**
     * Relasi: Guru (belongsTo).
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /**
     * Relasi: Pemesanan (hasMany).
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'kelas_id');
    }

    /**
     * Relasi: Siswa melalui Pemesanan (hasManyThrough).
     * (jika masih dipakai di tempat lain)
     */
    public function siswa()
    {
        return $this->hasManyThrough(
            Siswa::class,
            Pemesanan::class,
            'kelas_id',   // Foreign key di tabel pemesanan
            'id',         // Primary key di tabel siswa
            'id',         // Local key di tabel kelas
            'siswa_id'    // Foreign key di tabel pemesanan ke siswa
        );
    }

    /**
     * Relasi: pivot siswa_kelas (detail enrollment).
     */
    public function siswaKelas()
    {
        return $this->hasMany(SiswaKelas::class, 'kelas_id');
    }

    /**
     * Relasi: siswa yang terdaftar melalui pivot siswa_kelas.
     * Bisa dipakai untuk kebutuhan detail.
     */
    public function siswaTerdaftar()
    {
        return $this->belongsToMany(User::class, 'siswa_kelas', 'kelas_id', 'siswa_id')
            ->withPivot('progress', 'is_completed', 'status', 'enrolled_at', 'completed_at')
            ->withTimestamps();
    }

    /**
     * Alias untuk dipakai di view guru: $kelas->siswas->count()
     */
    public function siswas()
{
    return $this->belongsToMany(Siswa::class, 'siswa_kelas', 'kelas_id', 'siswa_id')
        ->withPivot('progress', 'is_completed', 'status', 'enrolled_at', 'completed_at')
        ->withTimestamps();
}

    public function materi(): HasMany
    {
        return $this->hasMany(Materi::class, 'kelas_id');
    }

    /**
     * Relasi: Materi Pembelajaran.
     */
    public function materiPembelajaran()
    {
        return $this->hasMany(MateriPembelajaran::class, 'kelas_id');
    }

    /**
     * Alias untuk compat: materiPembelajarans().
     */
    public function materiPembelajarans()
    {
        return $this->materiPembelajaran();
    }

    /**
     * Accessor: format harga rupiah.
     */
    public function getHargaFormatAttribute()
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Accessor: class badge status.
     */
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'aktif' ? 'success' : 'secondary';
    }

    /**
     * Accessor: class badge jenjang.
     */
    public function getJenjangBadgeAttribute()
    {
        $badges = [
            'SD'  => 'primary',
            'SMP' => 'success',
            'SMA' => 'danger',
        ];

        return $badges[$this->jenjang_pendidikan] ?? 'secondary';
    }

    /**
     * Scope: kelas aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope: filter by guru.
     */
    public function scopeByGuru($query, $guruId)
    {
        return $query->where('guru_id', $guruId);
    }

    /**
     * Scope: filter by jenjang.
     */
    public function scopeByJenjang($query, $jenjang)
    {
        return $query->where('jenjang_pendidikan', $jenjang);
    }

    /**
     * Scope: pencarian.
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_kelas', 'like', '%' . $keyword . '%')
                ->orWhere('deskripsi', 'like', '%' . $keyword . '%')
                ->orWhere('jenjang_pendidikan', 'like', '%' . $keyword . '%');
        });
    }

    /**
     * Scope: urut berdasarkan popularitas (jumlah_siswa).
     */
    public function scopePopular($query)
    {
        return $query->orderBy('jumlah_siswa', 'desc');
    }

    /**
     * Scope: urut terbaru.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Hitung ulang jumlah_siswa dari pemesanan.
     */
    public function updateJumlahSiswa()
    {
        $jumlah = $this->pemesanans()
            ->whereIn('status', ['lunas', 'aktif'])
            ->distinct('siswa_id')
            ->count('siswa_id');

        $this->jumlah_siswa = $jumlah;
        $this->saveQuietly();
    }

    /**
     * Cek apakah kelas penuh.
     */
    public function isFull($maxSiswa = 30)
    {
        return $this->jumlah_siswa >= $maxSiswa;
    }

    /**
     * Cek kepemilikan kelas oleh guru.
     */
    public function isOwnedBy($guruId)
    {
        return $this->guru_id === $guruId;
    }

    /**
     * Aktivasi kelas.
     */
    public function activate()
    {
        $this->status = 'aktif';
        return $this->save();
    }

    /**
     * Nonaktifkan kelas.
     */
    public function deactivate()
    {
        $this->status = 'nonaktif';
        return $this->save();
    }

    /**
     * Toggle status kelas.
     */
    public function toggleStatus()
    {
        $this->status = $this->status === 'aktif' ? 'nonaktif' : 'aktif';
        return $this->save();
    }

    /**
     * Opsi jenjang.
     */
    public static function getJenjangOptions()
    {
        return [
            'SD'  => 'Sekolah Dasar (SD)',
            'SMP' => 'Sekolah Menengah Pertama (SMP)',
            'SMA' => 'Sekolah Menengah Atas (SMA)',
        ];
    }

    /**
     * Opsi status.
     */
    public static function getStatusOptions()
    {
        return [
            'aktif'    => 'Aktif',
            'nonaktif' => 'Nonaktif',
        ];
    }
}
