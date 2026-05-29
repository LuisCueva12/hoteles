<?php

namespace Database\Seeders;

use App\Models\Ubicacion;
use Illuminate\Database\Seeder;

class UbicacionesSeeder extends Seeder
{
    public function run(): void
    {
        $ubicaciones = [
            [
                'nombre' => 'Lima',
                'slug' => 'lima',
                'descripcion' => 'Capital del Perú, principal centro urbano y económico del país',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1531968455001-5c5272a41129?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Cusco',
                'slug' => 'cusco',
                'descripcion' => 'Ciudad imperial, puerta de entrada a Machu Picchu',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1526392060635-9d6019884377?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Arequipa',
                'slug' => 'arequipa',
                'descripcion' => 'Ciudad blanca, segunda ciudad más importante del Perú',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1590439471364-192aa70c0b53?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Puno',
                'slug' => 'puno',
                'descripcion' => 'Capital folklórica del Perú, a orillas del Lago Titicaca',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1601584115197-04ecc0da31d7?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Trujillo',
                'slug' => 'trujillo',
                'descripcion' => 'Ciudad de la eterna primavera, capital de La Libertad',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Chiclayo',
                'slug' => 'chiclayo',
                'descripcion' => 'Capital de la amistad, importante centro comercial del norte',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1472396961693-142e6e269027?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Piura',
                'slug' => 'piura',
                'descripcion' => 'Ciudad del eterno sol, conocida por sus playas',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1507525428034-b723cf961d3e?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Ica',
                'slug' => 'ica',
                'descripcion' => 'Tierra del sol y del buen vino, famosa por sus viñedos',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Huancayo',
                'slug' => 'huancayo',
                'descripcion' => 'Ciudad incontrastable, centro comercial de la sierra central',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?w=1200&q=80',
                'activo' => true,
            ],
            [
                'nombre' => 'Ayacucho',
                'slug' => 'ayacucho',
                'descripcion' => 'Cuna de la libertad americana, famosa por su Semana Santa',
                'ruta_imagen' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1200&q=80',
                'activo' => true,
            ],
        ];

        foreach ($ubicaciones as $ubicacion) {
            Ubicacion::create($ubicacion);
        }
    }
}
