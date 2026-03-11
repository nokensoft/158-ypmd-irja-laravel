<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Galeri extends Model
{
    use SoftDeletes;

    protected $table = 'galeri';

    const KATEGORI_LIST = ['Kegiatan', 'Budaya', 'Komunitas', 'Program', 'Lainnya'];

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'kategori',
        'user_id',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class, 'galeri_media');
    }
}
