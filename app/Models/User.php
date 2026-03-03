<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nomor_hp',
        'keterangan_singkat',
        'is_active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    public function berita()
    {
        return $this->hasMany(Berita::class);
    }

    public function media()
    {
        return $this->hasMany(Media::class);
    }

    public function galeri()
    {
        return $this->hasMany(Galeri::class);
    }

    public function aktivitasLogin()
    {
        return $this->hasMany(AktivitasLogin::class);
    }
}
