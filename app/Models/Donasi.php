<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Donasi extends Model
{
    protected $table = 'donasi';

    protected $fillable = [
        'nama_donatur',
        'email',
        'telepon',
        'bank',
        'jumlah',
        'pesan',
        'bukti_transfer',
        'status',
        'catatan_admin',
        'tanggal',
    ];

    protected function casts(): array
    {
        return [
            'tanggal' => 'date',
            'jumlah'  => 'integer',
        ];
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
