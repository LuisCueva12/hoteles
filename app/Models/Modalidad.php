<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Modalidad extends Model
{
    protected $table = 'modalidades';

    protected $fillable = [
        'nombre',
        'slug',
        'activo',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($modalidad) {
            if (empty($modalidad->slug)) {
                $modalidad->slug = Str::slug($modalidad->nombre, '_');
            }
        });
    }

    public function movilidades(): BelongsToMany
    {
        return $this->belongsToMany(Movilidad::class, 'movilidad_modalidad')->withTimestamps();
    }
}
