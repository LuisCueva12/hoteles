<?php

namespace Database\Seeders;

use App\Models\Marca;
use Illuminate\Database\Seeder;

class MarcasSeeder extends Seeder
{
    public function run(): void
    {
        $marcas = [
            ['nombre' => 'Casa Andina', 'slug' => 'casa-andina', 'activo' => true],
            ['nombre' => 'Hilton Hotels', 'slug' => 'hilton', 'activo' => true],
            ['nombre' => 'Marriott International', 'slug' => 'marriott', 'activo' => true],
            ['nombre' => 'Sheraton Hotels', 'slug' => 'sheraton', 'activo' => true],
            ['nombre' => 'Decameron Resorts', 'slug' => 'decameron', 'activo' => true],
            ['nombre' => 'Costa del Sol', 'slug' => 'costa-del-sol', 'activo' => true],
            ['nombre' => 'Aranwa Hotels', 'slug' => 'aranwa', 'activo' => true],
            ['nombre' => 'Sonesta Hotels', 'slug' => 'sonesta', 'activo' => true],
        ];

        foreach ($marcas as $marca) {
            Marca::firstOrCreate(['slug' => $marca['slug']], $marca);
        }
    }
}
