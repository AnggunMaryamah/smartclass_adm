<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; 
use Illuminate\Support\Str;
use App\Models\Tugas;

class TugasSoal extends Model
{
    protected $table = 'tugas_soals';
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'tugas_id', 'pertanyaan', 'pilihan_a', 'pilihan_b', 
        'pilihan_c', 'pilihan_d', 'jawaban_benar',
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

    public function tugas(): BelongsTo 
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }
}
