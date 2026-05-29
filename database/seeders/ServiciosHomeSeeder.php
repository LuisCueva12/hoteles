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
                'slug' => 'traslado-aeropuerto',
                'titulo' => 'Traslado al aeropuerto',
                'categoria' => 'Movilidad 24/7',
                'descripcion' => 'Recojo y traslado puntual desde y hacia aeropuertos en las principales ciudades del Peru.',
                'imagen_url' => '/imagen1.jpg',
                'orden' => 1,
                'activo' => true
            ],
            [
                'slug' => 'viajes-interprovinciales',
                'titulo' => 'Viajes interprovinciales',
                'categoria' => 'Rutas nacionales',
                'descripcion' => 'Coordinamos viajes comodos y seguros hacia Cajamarca, Lima, Cusco, Arequipa y mas destinos.',
                'imagen_url' => '/imagen2.jpg',
                'orden' => 2,
                'activo' => true
            ],
            [
                'slug' => 'hospedaje-corporativo',
                'titulo' => 'Hospedaje corporativo',
                'categoria' => 'Empresas',
                'descripcion' => 'Alojamiento para equipos, ejecutivos, visitas comerciales y estadias prolongadas.',
                'imagen_url' => '/imagen4.jpg',
                'orden' => 3,
                'activo' => true
            ],
            [
                'slug' => 'eventos-especiales',
                'titulo' => 'Eventos especiales',
                'categoria' => 'Grupos y eventos',
                'descripcion' => 'Hospedaje, traslados y coordinacion para bodas, graduaciones, giras y encuentros especiales.',
                'imagen_url' => '/imagen5.jpg',
                'orden' => 4,
                'activo' => true
            ],
            [
                'slug' => 'turismo-escolar',
                'titulo' => 'Turismo escolar',
                'categoria' => 'Instituciones',
                'descripcion' => 'Soporte para excursiones educativas, grupos escolares y viajes institucionales.',
                'imagen_url' => '/imagen6.jpg',
                'orden' => 5,
                'activo' => true
            ],
            [
                'slug' => 'hoteles-verificados',
                'titulo' => 'Hoteles verificados',
                'categoria' => 'Alojamiento seguro',
                'descripcion' => 'Hoteles revisados con habitaciones comodas, ubicaciones convenientes y atencion directa.',
                'imagen_url' => '/imagen7.jpg',
                'orden' => 6,
                'activo' => true
            ],
            [
                'slug' => 'atencion-personalizada',
                'titulo' => 'Atencion personalizada',
                'categoria' => 'Asesoria directa',
                'descripcion' => 'Acompanamiento por WhatsApp para elegir hotel, fechas y condiciones segun tu viaje.',
                'imagen_url' => '/imagen8.jpg',
                'orden' => 7,
                'activo' => true
            ],
            [
                'slug' => 'paquetes-medida',
                'titulo' => 'Paquetes a medida',
                'categoria' => 'Viajes y estadias',
                'descripcion' => 'Armamos alternativas de estadia y movilidad para familias, empresas y grupos.',
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
