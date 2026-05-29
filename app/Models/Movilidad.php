<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class Movilidad extends Model
{
    use HasFactory;

    protected $table = 'movilidades';

    protected $fillable = ['nombre', 'slug', 'marca_id', 'categoria', 'precio_base', 'capacidad_pasajeros', 'ruta_imagen', 'activo'];

    protected $casts = ['precio_base' => 'decimal:2', 'activo' => 'boolean'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($movilidad) {
            if (empty($movilidad->slug)) {
                $movilidad->slug = Str::slug($movilidad->nombre);
            }
        });

        static::saved(function ($movilidad) {
            Artisan::call('app:generate-seo-files');
        });

        static::deleted(function ($movilidad) {
            Artisan::call('app:generate-seo-files');
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function reservas(): HasMany
    {
        return $this->hasMany(Reserva::class);
    }

    public function marca(): BelongsTo
    {
        return $this->belongsTo(Marca::class);
    }

    public function ubicaciones(): BelongsToMany
    {
        return $this->belongsToMany(Ubicacion::class, 'movilidad_ubicacion')->withPivot('precio_ajuste')->withTimestamps();
    }

    public function rutas(): BelongsToMany
    {
        return $this->belongsToMany(Ruta::class, 'movilidad_ruta')->withPivot('precio_ruta')->withTimestamps();
    }

    public function movilidadRutas(): HasMany
    {
        return $this->hasMany(MovilidadRuta::class);
    }

    public function modalidades(): BelongsToMany
    {
        return $this->belongsToMany(Modalidad::class, 'movilidad_modalidad')->withTimestamps();
    }

    public function caracteristicas(): BelongsToMany
    {
        return $this->belongsToMany(Caracteristica::class, 'movilidad_caracteristica')->withTimestamps();
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

    public function getPrecioFormateadoAttribute(): string
    {
        return 'S/. '.number_format($this->precio_base, 2);
    }

    public function estaDisponible(): bool
    {
        return $this->activo;
    }

    public function getCapitalCategoriaAttribute(): string
    {
        return ucfirst($this->categoria);
    }

    public static function maximaCapacidadDisponible(): int
    {
        return cache()->remember('max_capacidad_pasajeros', 3600, function () {
            return (int) self::where('activo', true)->max('capacidad_pasajeros') ?: 50;
        });
    }
}
