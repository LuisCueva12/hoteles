<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Destino extends Model
{
    protected $table = 'destinos';

    protected $fillable = [
        'nombre',
        'slug',
        'departamento',
        'tipo',
        'descripcion',
        'imagen_url',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($destino) {
            if (empty($destino->slug)) {
                $destino->slug = Str::slug($destino->nombre);
            }
        });
    }

    public function hoteles(): BelongsToMany
    {
        return $this->belongsToMany(Hotel::class, 'hotel_destino', 'destino_id', 'hotel_id')
            ->withPivot('precio_ajuste')
            ->withTimestamps();
    }
}
