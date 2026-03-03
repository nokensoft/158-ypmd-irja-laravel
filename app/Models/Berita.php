<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Berita extends Model
{
    use SoftDeletes;

    protected $table = 'berita';

    protected $fillable = [
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'sumber_nama',
        'sumber_link',
        'kategori_berita_id',
        'media_id',
        'gambar_url',
        'user_id',
        'status',
        'tanggal_terbit',
    ];

    protected $casts = [
        'tanggal_terbit' => 'date',
    ];

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    public function kategori()
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_berita_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getGambarAttribute(): string
    {
        if ($this->media && $this->media->file_path) {
            return asset('storage/' . $this->media->file_path);
        }

        if ($this->gambar_url) {
            if (str_starts_with($this->gambar_url, 'http')) {
                return $this->gambar_url;
            }
            return asset('storage/' . $this->gambar_url);
        }

        return asset('img/logo-koni-papua-pegunungan-transparant.png');
    }
}
