<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuracion extends Model
{
    protected $table = 'configuraciones';

    protected $fillable = [
        'telefono_whatsapp',
        'enlace_facebook',
        'enlace_instagram',
    ];

    public static function obtenerConfiguracion()
    {
        return self::firstOrCreate(
            ['id' => 1],
            [
                'telefono_whatsapp' => '51987654321',
                'enlace_facebook' => null,
                'enlace_instagram' => null,
            ]
        );
    }

    public function enlaceTelefono(): string
    {
        $digitos = preg_replace('/\D+/', '', (string) $this->telefono_whatsapp);

        return $digitos === '' ? '#' : 'tel:+' . $digitos;
    }

    public function etiquetaTelefonoLegible(): string
    {
        $digitos = preg_replace('/\D+/', '', (string) $this->telefono_whatsapp);

        if ($digitos === '') {
            return '';
        }

        if (strlen($digitos) === 11 && str_starts_with($digitos, '51')) {
            $n = substr($digitos, 2);

            return '+51 ' . substr($n, 0, 3) . ' ' . substr($n, 3, 3) . ' ' . substr($n, 6);
        }

        return '+' . $digitos;
    }
}
