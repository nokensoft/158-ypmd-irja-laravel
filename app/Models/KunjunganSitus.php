<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KunjunganSitus extends Model
{
    protected $table = 'kunjungan_situs';

    public $timestamps = false;

    protected $fillable = ['ip_address', 'tanggal', 'url', 'user_agent'];

    protected $casts = [
        'tanggal' => 'date',
    ];
}
