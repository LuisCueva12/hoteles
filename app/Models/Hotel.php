<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Hotel extends Model
{
    protected $table = 'hoteles';

    protected $fillable = [
        'nombre',
        'slug',
        'marca_id',
        'categoria',
        'precio_base',
        'capacidad_personas',
        'caracteristicas',
        'ruta_imagen',
        'activo',
    ];

    protected $casts = [
        'caracteristicas' => 'array',
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($hotel) {
            if (empty($hotel->slug)) {
                $hotel->slug = Str::slug($hotel->nombre);
            }
        });
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class, 'marca_id');
    }

    public function destinos(): BelongsToMany
    {
        return $this->belongsToMany(Destino::class, 'hotel_destino', 'hotel_id', 'destino_id')
            ->withPivot('precio_ajuste')
            ->withTimestamps();
    }

    public function modalidades(): BelongsToMany
    {
        return $this->belongsToMany(Modalidad::class, 'hotel_modalidad', 'hotel_id', 'modalidad_id')
            ->withTimestamps();
    }

    public function caracteristicas(): BelongsToMany
    {
        return $this->belongsToMany(Caracteristica::class, 'hotel_caracteristica', 'hotel_id', 'caracteristica_id')
            ->withTimestamps();
    }

    // =========================================================================
    // HOTEL HELPERS
    // =========================================================================

    public function getTieneImagenAttribute(): bool
    {
        return !empty($this->ruta_imagen);
    }

    public function getImagenUrlAttribute(): string
    {
        if (!$this->ruta_imagen) {
            return asset('images/placeholder-hotel.png');
        }

        return str_starts_with($this->ruta_imagen, 'http')
            ? $this->ruta_imagen
            : asset("storage/{$this->ruta_imagen}");
    }

    public function getCapitalCategoriaAttribute(): string
    {
        return ucfirst($this->categoria);
    }
}
