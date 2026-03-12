<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donasi extends Model
{
    use SoftDeletes;
    protected $table = 'donasi';

    protected $fillable = [
        'program_donasi_id',
        'nama_donatur',
        'is_anonim',
        'email',
        'telepon',
        'bank',
        'jumlah',
        'pesan',
        'bukti_transfer',
        'status',
        'catatan_admin',
        'tanggal',
        'is_publik',
    ];

    protected function casts(): array
    {
        return [
            'tanggal'   => 'date',
            'jumlah'    => 'integer',
            'is_anonim' => 'boolean',
            'is_publik' => 'boolean',
        ];
    }

    public function programDonasi()
    {
        return $this->belongsTo(ProgramDonasi::class);
    }

    public function getNamaTampilAttribute(): string
    {
        return $this->is_anonim ? 'Anonim' : $this->nama_donatur;
    }

    public function getJumlahFormatAttribute(): string
    {
        return $this->jumlah ? 'Rp ' . number_format($this->jumlah, 0, ',', '.') : '-';
    }

    public function getBuktiUrlAttribute(): ?string
    {
        return $this->bukti_transfer ? asset('storage/' . $this->bukti_transfer) : null;
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'dikonfirmasi' => 'Dikonfirmasi',
            'ditolak'      => 'Ditolak',
            default        => 'Pending',
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'dikonfirmasi' => 'bg-green-100 text-green-700',
            'ditolak'      => 'bg-red-100 text-red-700',
            default        => 'bg-yellow-100 text-yellow-700',
        };
    }
}
