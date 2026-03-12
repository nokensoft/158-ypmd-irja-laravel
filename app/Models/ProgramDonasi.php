<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class ProgramDonasi extends Model
{
    use SoftDeletes;

    protected $table = 'program_donasi';

    const BANK_NAMA = 'BNI';
    const BANK_NO_REKENING = '0349-1234-5678';
    const BANK_ATAS_NAMA = 'Yayasan Pembangunan Masyarakat Desa Irian Jaya';

    protected $fillable = [
        'judul',
        'slug',
        'deskripsi',
        'media_id',
        'target_nominal',
        'is_active',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'target_nominal' => 'integer',
            'is_active' => 'boolean',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul);
            }
        });
    }

    public function media()
    {
        return $this->belongsTo(Media::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function donasi()
    {
        return $this->hasMany(Donasi::class);
    }

    public function donasiDikonfirmasi()
    {
        return $this->hasMany(Donasi::class)->where('status', 'dikonfirmasi');
    }

    public function getGambarAttribute(): string
    {
        if ($this->media && $this->media->file_path) {
            return asset('storage/' . $this->media->file_path);
        }

        return asset('img/logo-ypmd-irja.png');
    }

    public function getTargetFormatAttribute(): ?string
    {
        return $this->target_nominal
            ? 'Rp ' . number_format($this->target_nominal, 0, ',', '.')
            : null;
    }

    public function getTerkumpulAttribute(): int
    {
        return (int) $this->donasiDikonfirmasi()->sum('jumlah');
    }

    public function getTerkumpulFormatAttribute(): string
    {
        return 'Rp ' . number_format($this->terkumpul, 0, ',', '.');
    }

    public function getProgressPersenAttribute(): ?int
    {
        if (!$this->target_nominal) {
            return null;
        }

        $persen = (int) round(($this->terkumpul / $this->target_nominal) * 100);

        return min($persen, 100);
    }
}
