<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reserva extends Model
{
    use HasFactory;

    protected $table = 'reservas';

    protected $fillable = [
        'movilidad_id',
        'cliente_nombre',
        'cliente_documento',
        'cliente_whatsapp',
        'ruta_viaje',
        'fecha_inicio',
        'fecha_fin',
        'modalidad',
        'adultos',
        'ninos',
        'detalles',
        'estado',
    ];

    protected $casts = [
        'fecha_inicio' => 'date',
        'fecha_fin' => 'date',
        'adultos' => 'integer',
        'ninos' => 'integer',
    ];

    public function movilidad(): BelongsTo
    {
        return $this->belongsTo(Movilidad::class);
    }
}
