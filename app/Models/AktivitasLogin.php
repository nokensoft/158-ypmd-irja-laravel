<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AktivitasLogin extends Model
{
    protected $table = 'aktivitas_login';

    protected $fillable = [
        'user_id',
        'nama',
        'email',
        'ip_address',
        'user_agent',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
