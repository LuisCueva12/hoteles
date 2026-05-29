<?php

namespace Database\Seeders;

use App\Models\TestimonioHome;
use Illuminate\Database\Seeder;

class TestimoniosHomeSeeder extends Seeder
{
    public function run(): void
    {
        $testimonios = [
            [
                'nombre' => 'Maria Garcia',
                'origen' => 'Lima',
                'cargo' => 'Viajera frecuente',
                'calificacion' => 5,
                'texto' => 'Reserve el hotel en Cajamarca por WhatsApp y en menos de 5 minutos tenia la confirmacion. Sin formularios, sin comisiones.',
                'color' => '#2563EB',
                'orden' => 1,
                'activo' => true
            ],
            [
                'nombre' => 'Roberto Sanchez',
                'origen' => 'Trujillo',
                'cargo' => 'Reserva familiar',
                'calificacion' => 5,
                'texto' => 'Llegue al hotel y todo estuvo como me lo describieron: limpio, comodo y en perfecto estado. Adventur realmente verifica.',
                'color' => '#7C3AED',
                'orden' => 2,
                'activo' => true
            ],
            [
                'nombre' => 'Lucia Torres',
                'origen' => 'Arequipa',
                'cargo' => 'Viaje en familia',
                'calificacion' => 5,
                'texto' => 'El precio que vi fue el que pague, sin sorpresas. La atencion fue personalizada y me ayudaron a elegir el hotel ideal.',
                'color' => '#DB2777',
                'orden' => 3,
                'activo' => true
            ],
            [
                'nombre' => 'Carlos Mendoza',
                'origen' => 'Chiclayo',
                'cargo' => 'Grupo familiar',
                'calificacion' => 5,
                'texto' => 'Organice el viaje de toda la familia a Cajamarca. Adventur consiguio habitaciones con disponibilidad inmediata.',
                'color' => '#059669',
                'orden' => 4,
                'activo' => true
            ],
            [
                'nombre' => 'Ana Rodriguez',
                'origen' => 'Cusco',
                'cargo' => 'Viaje individual',
                'calificacion' => 5,
                'texto' => 'Me orientaron sobre que hotel elegir segun mi presupuesto y me senti completamente segura durante todo el proceso.',
                'color' => '#D97706',
                'orden' => 5,
                'activo' => true
            ]
        ];

        foreach ($testimonios as $testimonio) {
            TestimonioHome::updateOrCreate(
                ['nombre' => $testimonio['nombre'], 'origen' => $testimonio['origen']],
                $testimonio
            );
        }
    }
}
