<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = [
            ['nombre' => 'Toyota', 'slug' => 'toyota', 'activo' => true],
            ['nombre' => 'Hyundai', 'slug' => 'hyundai', 'activo' => true],
            ['nombre' => 'Mercedes-Benz', 'slug' => 'mercedes-benz', 'activo' => true],
            ['nombre' => 'Volkswagen', 'slug' => 'volkswagen', 'activo' => true],
            ['nombre' => 'Nissan', 'slug' => 'nissan', 'activo' => true],
            ['nombre' => 'Chevrolet', 'slug' => 'chevrolet', 'activo' => true],
            ['nombre' => 'Ford', 'slug' => 'ford', 'activo' => true],
            ['nombre' => 'Kia', 'slug' => 'kia', 'activo' => true],
            ['nombre' => 'Mazda', 'slug' => 'mazda', 'activo' => true],
            ['nombre' => 'Honda', 'slug' => 'honda', 'activo' => true],
        ];

        foreach ($marcas as $marca) {
            Marca::create($marca);
        }
    }
}
