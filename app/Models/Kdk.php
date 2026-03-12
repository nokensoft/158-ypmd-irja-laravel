<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kdk extends Model
{
    use SoftDeletes;

    protected $table = 'kdk';

    protected $fillable = [
        'nomor_edisi',
        'judul',
        'deskripsi',
        'tanggal_terbit',
        'file_pdf',
        'jumlah_dibaca',
        'jumlah_unduhan',
        'media_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_terbit' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function getGambarAttribute(): string
    {
        if ($this->media && $this->media->file_path) {
            return asset('storage/' . $this->media->file_path);
        }

        return asset('img/logo-ypmd-irja.png');
    }

    public function getPdfUrlAttribute(): ?string
    {
        return $this->file_pdf ? asset('storage/' . $this->file_pdf) : null;
    }
}
