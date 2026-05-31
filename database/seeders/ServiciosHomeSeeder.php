<?php

namespace Database\Seeders;

use App\Models\ServicioHome;
use Illuminate\Database\Seeder;

class ServiciosHomeSeeder extends Seeder
{
    public function run(): void
    {
        $servicios = [
            [
                'slug' => 'reservas-hotel',
                'titulo' => 'Reservas de hotel',
                'categoria' => 'Alojamiento',
                'descripcion' => 'Encuentra y reserva tu habitación ideal en segundos. Disponibilidad en tiempo real y confirmación inmediata por WhatsApp.',
                'imagen_url' => '/imagen1.jpg',
                'orden' => 1,
                'activo' => true
            ],
            [
                'slug' => 'hospedaje-corporativo',
                'titulo' => 'Hospedaje corporativo',
                'categoria' => 'Empresas',
                'descripcion' => 'Alojamiento para ejecutivos, equipos, visitas comerciales y estadías prolongadas con facturación electrónica.',
                'imagen_url' => '/imagen2.jpg',
                'orden' => 2,
                'activo' => true
            ],
            [
                'slug' => 'paquetes-familiares',
                'titulo' => 'Paquetes familiares',
                'categoria' => 'Familias',
                'descripcion' => 'Habitaciones amplias y espacios pensados para disfrutar en familia, con opciones de desayuno incluido y amenidades.',
                'imagen_url' => '/imagen4.jpg',
                'orden' => 3,
                'activo' => true
            ],
            [
                'slug' => 'eventos-especiales',
                'titulo' => 'Eventos especiales',
                'categoria' => 'Grupos y eventos',
                'descripcion' => 'Coordinamos bloques de habitaciones para bodas, graduaciones, giras y encuentros con tarifas preferenciales.',
                'imagen_url' => '/imagen5.jpg',
                'orden' => 4,
                'activo' => true
            ],
            [
                'slug' => 'turismo-escolar',
                'titulo' => 'Turismo escolar',
                'categoria' => 'Instituciones',
                'descripcion' => 'Alojamiento para excursiones educativas, grupos escolares y viajes institucionales con atención coordinada.',
                'imagen_url' => '/imagen6.jpg',
                'orden' => 5,
                'activo' => true
            ],
            [
                'slug' => 'hoteles-verificados',
                'titulo' => 'Hoteles verificados',
                'categoria' => 'Alojamiento seguro',
                'descripcion' => 'Hoteles revisados y validados con habitaciones cómodas, ubicaciones convenientes y atención directa garantizada.',
                'imagen_url' => '/imagen7.jpg',
                'orden' => 6,
                'activo' => true
            ],
            [
                'slug' => 'atencion-personalizada',
                'titulo' => 'Atención personalizada',
                'categoria' => 'Asesoría directa',
                'descripcion' => 'Acompañamiento por WhatsApp para elegir hotel, fechas y condiciones según tu viaje y presupuesto.',
                'imagen_url' => '/imagen8.jpg',
                'orden' => 7,
                'activo' => true
            ],
            [
                'slug' => 'paquetes-medida',
                'titulo' => 'Paquetes a medida',
                'categoria' => 'Viajes y estadías',
                'descripcion' => 'Armamos alternativas de estadía para familias, empresas y grupos según destino, fechas y número de huéspedes.',
                'imagen_url' => '/imagen9.jpg',
                'orden' => 8,
                'activo' => true
            ]
        ];

        foreach ($servicios as $servicio) {
            ServicioHome::updateOrCreate(['slug' => $servicio['slug']], $servicio);
        }
    }
}
