<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class CabangOlahraga extends Model
{
    use SoftDeletes;

    protected $table = 'cabang_olahraga';

    protected $fillable = [
        'nama',
        'slug',
        'icon',
        'jumlah_atlet',
        'jumlah_medali',
        'deskripsi',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('nama') && !$model->isDirty('slug')) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }
}
