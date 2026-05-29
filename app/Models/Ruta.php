<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Ruta extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'origen',
        'destino',
        'descripcion',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ruta) {
            if (empty($ruta->slug)) {
                $ruta->slug = Str::slug($ruta->nombre);
            }
        });
    }

    public function movilidades(): BelongsToMany
    {
        return $this->belongsToMany(Movilidad::class, 'movilidad_ruta')
                    ->withPivot('precio_ruta')
                    ->withTimestamps();
    }
}
