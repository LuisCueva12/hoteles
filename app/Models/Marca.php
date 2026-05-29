<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Marca extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'logo',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($marca) {
            if (empty($marca->slug)) {
                $marca->slug = Str::slug($marca->nombre);
            }
        });
    }

    public function movilidades(): HasMany
    {
        return $this->hasMany(Movilidad::class);
    }

    public function getLogoUrlAttribute(): string
    {
        if (!$this->logo) {
            return asset('images/placeholder-logo.png');
        }

        return str_starts_with($this->logo, 'http')
            ? $this->logo
            : asset("storage/{$this->logo}");
    }

    public function getTieneLogoAttribute(): bool
    {
        return !empty($this->logo);
    }
}
