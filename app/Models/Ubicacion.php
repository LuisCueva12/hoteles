<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Ubicacion extends Model
{
    protected $table = 'ubicaciones';

    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'ruta_imagen',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ubicacion) {
            if (empty($ubicacion->slug)) {
                $ubicacion->slug = Str::slug($ubicacion->nombre);
            }
        });
    }

    public function movilidades(): BelongsToMany
    {
        return $this->belongsToMany(Movilidad::class, 'movilidad_ubicacion')
            ->withPivot('precio_ajuste')
            ->withTimestamps();
    }

    public function getImagenUrlAttribute(): string
    {
        if (! $this->ruta_imagen) {
            return asset('placeholder.png');
        }

        return str_starts_with($this->ruta_imagen, 'http') ? $this->ruta_imagen : asset("storage/{$this->ruta_imagen}");
    }

    public function getTieneImagenAttribute(): bool
    {
        return ! empty($this->ruta_imagen);
    }
}
