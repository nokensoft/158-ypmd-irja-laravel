<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class KategoriBerita extends Model
{
    use SoftDeletes;

    protected $table = 'kategori_berita';

    protected $fillable = ['nama', 'slug'];

    protected static function booted(): void
    {
        static::saving(function ($model) {
            if (empty($model->slug) || ($model->isDirty('nama') && !$model->isDirty('slug'))) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }
}
