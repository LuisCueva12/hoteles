<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Seeder;

class CategoriasSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Económico', 'descripcion' => 'Vehículos económicos y accesibles', 'orden' => 1],
            ['nombre' => 'Estándar', 'descripcion' => 'Vehículos de gama media con buen confort', 'orden' => 2],
            ['nombre' => 'Premium', 'descripcion' => 'Vehículos de alta gama con máximo confort', 'orden' => 3],
            ['nombre' => 'Ejecutivo', 'descripcion' => 'Vehículos para ejecutivos y eventos corporativos', 'orden' => 4],
            ['nombre' => 'Turístico', 'descripcion' => 'Vehículos ideales para tours y viajes largos', 'orden' => 5],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
