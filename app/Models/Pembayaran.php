<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pembayaran extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'pemesanan_id', 'tanggal_pembayaran', 'metode_pembayaran', 
        'nominal_pembayaran', 'bukti_pembayaran', 'status_pembayaran'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
}

