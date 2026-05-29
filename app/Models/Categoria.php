<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $fillable = [
        'nombre',
        'slug',
        'descripcion',
        'activo',
        'orden',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($categoria) {
            if (empty($categoria->slug)) {
                $categoria->slug = Str::slug($categoria->nombre);
            }
        });

        static::updating(function ($categoria) {
            if ($categoria->isDirty('nombre')) {
                $categoria->slug = Str::slug($categoria->nombre);
            }
        });
    }

    public function movilidades()
    {
        return $this->hasMany(Movilidad::class, 'categoria', 'nombre');
    }

    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }

    public function scopeOrdenadas($query)
    {
        return $query->orderBy('orden')->orderBy('nombre');
    }
}
