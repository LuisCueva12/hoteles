<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Caracteristica extends Model
{
    protected $table = 'caracteristicas';

    protected $fillable = [
        'nombre',
        'slug',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($caracteristica) {
            if (empty($caracteristica->slug)) {
                $caracteristica->slug = Str::slug($caracteristica->nombre, '_');
            }
        });
    }

    public function movilidades(): BelongsToMany
    {
        return $this->belongsToMany(Movilidad::class, 'movilidad_caracteristica')->withTimestamps();
    }
}
