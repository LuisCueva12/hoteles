<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MovilidadRuta extends Pivot
{
    protected $table = 'movilidad_ruta';
    
    public $incrementing = true;
    
    protected $fillable = [
        'movilidad_id',
        'ruta_id',
        'precio_ruta',
    ];

    public function movilidad(): BelongsTo
    {
        return $this->belongsTo(Movilidad::class);
    }

    public function ruta(): BelongsTo
    {
        return $this->belongsTo(Ruta::class);
    }
}
