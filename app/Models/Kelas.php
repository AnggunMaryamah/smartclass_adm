<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Kelas extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'kelas';

    /**
     * The primary key type.
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
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
        'jadwal_kelas',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'harga' => 'integer',
        'jumlah_siswa' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
    ];

    /**
     * Boot function untuk generate UUID
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });

        // COMMENT DULU untuk debugging - Aktifkan setelah tabel pemesanan ready
        // static::saved(function ($model) {
        //     $model->updateJumlahSiswa();
        // });
    }

    /**
     * Relationship: Guru (Belongs To)
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }

    /**
     * Relationship: Pemesanan (Has Many)
     */
    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class, 'kelas_id');
    }

    /**
     * Relationship: Siswa melalui Pemesanan (Has Many Through)
     */
    public function siswa()
    {
        return $this->hasManyThrough(
            Siswa::class,
            Pemesanan::class,
            'kelas_id',
            'id',
            'id',
            'siswa_id'
        );
    }

    /**
     * Relationship: Siswa yang terdaftar (untuk pivot table jika ada)
     */
    public function siswaTerdaftar()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswa', 'kelas_id', 'siswa_id')
            ->withPivot('tanggal_daftar', 'status')
            ->withTimestamps();
    }

    /**
     * ✅ TAMBAHAN: Alias untuk siswas() - untuk compatibility dengan view
     * Mengembalikan siswa yang terdaftar melalui pivot table
     */
    public function siswas()
    {
        return $this->belongsToMany(Siswa::class, 'kelas_siswa', 'kelas_id', 'siswa_id')
            ->withTimestamps();
    }

    /**
     * Relationship: Materi Pembelajaran
     */
    public function materiPembelajaran()
    {
        return $this->hasMany(MateriPembelajaran::class, 'kelas_id');
    }

    /**
     * ✅ TAMBAHAN: Alias untuk materiPembelajarans() - untuk compatibility dengan view
     */
    public function materiPembelajarans()
    {
        return $this->materiPembelajaran();
    }

    /**
     * Accessor: Format Harga (Rupiah)
     */
    public function getHargaFormatAttribute()
    {
        return 'Rp '.number_format($this->harga, 0, ',', '.');
    }

    /**
     * Accessor: Status Badge Color
     */
    public function getStatusBadgeAttribute()
    {
        return $this->status === 'aktif' ? 'success' : 'secondary';
    }

    /**
     * Accessor: Jenjang Badge Color
     */
    public function getJenjangBadgeAttribute()
    {
        $badges = [
            'SD' => 'primary',
            'SMP' => 'success',
            'SMA' => 'danger',
        ];

        return $badges[$this->jenjang_pendidikan] ?? 'secondary';
    }

    /**
     * Scope: Kelas Aktif
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Scope: Kelas By Guru
     */
    public function scopeByGuru($query, $guruId)
    {
        return $query->where('guru_id', $guruId);
    }

    /**
     * Scope: Kelas By Jenjang
     */
    public function scopeByJenjang($query, $jenjang)
    {
        return $query->where('jenjang_pendidikan', $jenjang);
    }

    /**
     * Scope: Search (nama kelas, deskripsi, jenjang)
     */
    public function scopeSearch($query, $keyword)
    {
        return $query->where(function ($q) use ($keyword) {
            $q->where('nama_kelas', 'like', '%'.$keyword.'%')
                ->orWhere('deskripsi', 'like', '%'.$keyword.'%')
                ->orWhere('jenjang_pendidikan', 'like', '%'.$keyword.'%');
        });
    }

    /**
     * Scope: Order By Popular (based on jumlah_siswa)
     */
    public function scopePopular($query)
    {
        return $query->orderBy('jumlah_siswa', 'desc');
    }

    /**
     * Scope: Order By Latest
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    /**
     * Method: Update Jumlah Siswa
     */
    public function updateJumlahSiswa()
    {
        // Hitung siswa dari pemesanan yang sudah dibayar
        $jumlah = $this->pemesanans()
            ->whereIn('status', ['lunas', 'aktif'])
            ->distinct('siswa_id')
            ->count('siswa_id');

        $this->jumlah_siswa = $jumlah;
        $this->saveQuietly();
    }

    /**
     * Method: Check if Kelas is Full
     */
    public function isFull($maxSiswa = 30)
    {
        return $this->jumlah_siswa >= $maxSiswa;
    }

    /**
     * Method: Check if Guru owns this Kelas
     */
    public function isOwnedBy($guruId)
    {
        return $this->guru_id === $guruId;
    }

    /**
     * Method: Activate Kelas
     */
    public function activate()
    {
        $this->status = 'aktif';

        return $this->save();
    }

    /**
     * Method: Deactivate Kelas
     */
    public function deactivate()
    {
        $this->status = 'nonaktif';

        return $this->save();
    }

    /**
     * Method: Toggle Status
     */
    public function toggleStatus()
    {
        $this->status = $this->status === 'aktif' ? 'nonaktif' : 'aktif';

        return $this->save();
    }

    /**
     * Static Method: Get Available Jenjang
     */
    public static function getJenjangOptions()
    {
        return [
            'SD' => 'Sekolah Dasar (SD)',
            'SMP' => 'Sekolah Menengah Pertama (SMP)',
            'SMA' => 'Sekolah Menengah Atas (SMA)',
        ];
    }

    /**
     * Static Method: Get Status Options
     */
    public static function getStatusOptions()
    {
        return [
            'aktif' => 'Aktif',
            'nonaktif' => 'Nonaktif',
        ];
    }
}
