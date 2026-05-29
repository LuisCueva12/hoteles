<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => '3 Estrellas', 'descripcion' => 'Hoteles cómodos y accesibles con servicios básicos esenciales', 'orden' => 1],
            ['nombre' => '4 Estrellas', 'descripcion' => 'Hoteles de gama media-alta con excelente confort y atención', 'orden' => 2],
            ['nombre' => '5 Estrellas', 'descripcion' => 'Hoteles de lujo con los más altos estándares de calidad', 'orden' => 3],
            ['nombre' => 'Boutique', 'descripcion' => 'Alojamiento exclusivo y personalizado con un estilo único', 'orden' => 4],
            ['nombre' => 'Resort', 'descripcion' => 'Complejo hotelero con todo incluido y múltiples actividades recreativas', 'orden' => 5],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(['nombre' => $categoria['nombre']], $categoria);
        }
    }
}
