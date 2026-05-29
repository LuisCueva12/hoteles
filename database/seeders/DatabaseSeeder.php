<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsuariosSeeder::class,
            CategoriasSeeder::class,
            MarcasSeeder::class,
            DestinosSeeder::class,
            HotelesSeeder::class,
            ServiciosHomeSeeder::class,
            TestimoniosHomeSeeder::class,
        ]);
    }
}
