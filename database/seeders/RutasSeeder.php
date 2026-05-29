<?php

namespace Database\Seeders;

use App\Models\Ruta;
use Illuminate\Database\Seeder;

class RutasSeeder extends Seeder
{
    public function run(): void
    {
        $rutas = [
            [
                'nombre' => 'Lima - Cusco',
                'slug' => 'lima-cusco',
                'origen' => 'Lima',
                'destino' => 'Cusco',
                'descripcion' => 'Ruta turística principal hacia Machu Picchu',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Arequipa',
                'slug' => 'lima-arequipa',
                'origen' => 'Lima',
                'destino' => 'Arequipa',
                'descripcion' => 'Ruta hacia la ciudad blanca',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Puno',
                'slug' => 'lima-puno',
                'origen' => 'Lima',
                'destino' => 'Puno',
                'descripcion' => 'Ruta hacia el Lago Titicaca',
                'activo' => true,
            ],
            [
                'nombre' => 'Cusco - Puno',
                'slug' => 'cusco-puno',
                'origen' => 'Cusco',
                'destino' => 'Puno',
                'descripcion' => 'Ruta del altiplano entre dos destinos turísticos',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Trujillo',
                'slug' => 'lima-trujillo',
                'origen' => 'Lima',
                'destino' => 'Trujillo',
                'descripcion' => 'Ruta hacia el norte del país',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Chiclayo',
                'slug' => 'lima-chiclayo',
                'origen' => 'Lima',
                'destino' => 'Chiclayo',
                'descripcion' => 'Ruta hacia Lambayeque',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Piura',
                'slug' => 'lima-piura',
                'origen' => 'Lima',
                'destino' => 'Piura',
                'descripcion' => 'Ruta hacia el extremo norte',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Ica',
                'slug' => 'lima-ica',
                'origen' => 'Lima',
                'destino' => 'Ica',
                'descripcion' => 'Ruta corta hacia el sur, ideal para fines de semana',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Huancayo',
                'slug' => 'lima-huancayo',
                'origen' => 'Lima',
                'destino' => 'Huancayo',
                'descripcion' => 'Ruta hacia la sierra central',
                'activo' => true,
            ],
            [
                'nombre' => 'Arequipa - Puno',
                'slug' => 'arequipa-puno',
                'origen' => 'Arequipa',
                'destino' => 'Puno',
                'descripcion' => 'Ruta del sur andino',
                'activo' => true,
            ],
            [
                'nombre' => 'Cusco - Arequipa',
                'slug' => 'cusco-arequipa',
                'origen' => 'Cusco',
                'destino' => 'Arequipa',
                'descripcion' => 'Ruta entre dos ciudades turísticas importantes',
                'activo' => true,
            ],
            [
                'nombre' => 'Lima - Ayacucho',
                'slug' => 'lima-ayacucho',
                'origen' => 'Lima',
                'destino' => 'Ayacucho',
                'descripcion' => 'Ruta hacia la ciudad histórica',
                'activo' => true,
            ],
        ];

        foreach ($rutas as $ruta) {
            Ruta::create($ruta);
        }
    }
}
