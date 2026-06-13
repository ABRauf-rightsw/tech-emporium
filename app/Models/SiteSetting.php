<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public const HERO_BACKGROUND_KEY = 'hero_background';

    public const DEFAULT_HERO_BACKGROUND = 'assets/images/banners/hero-bg.svg';

    protected $fillable = ['key', 'value'];

    public static function get(string $key, ?string $default = null): ?string
    {
        $value = static::where('key', $key)->value('value');

        return $value !== null && $value !== '' ? $value : $default;
    }

    public static function set(string $key, ?string $value): void
    {
        if ($value === null || $value === '') {
            static::where('key', $key)->delete();

            return;
        }

        static::updateOrCreate(['key' => $key], ['value' => $value]);
    }
}
