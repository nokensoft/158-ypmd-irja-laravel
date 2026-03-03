<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengaturanSitus extends Model
{
    protected $table = 'pengaturan_situs';

    protected $fillable = ['key', 'value'];

    public static function getValue(string $key, mixed $default = null): mixed
    {
        return static::where('key', $key)->value('value') ?? $default;
    }

    public static function setValue(string $key, mixed $value): void
    {
        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
