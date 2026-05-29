<?php

namespace Database\Seeders;

use App\Models\Movilidad;
use App\Models\Ubicacion;
use App\Models\Ruta;
use Illuminate\Database\Seeder;

class MovilidadUbicacionRutaSeeder extends Seeder
{
    public function run(): void
    {
        $lima = Ubicacion::where('slug', 'lima')->first();
        $cusco = Ubicacion::where('slug', 'cusco')->first();
        $arequipa = Ubicacion::where('slug', 'arequipa')->first();
        $puno = Ubicacion::where('slug', 'puno')->first();
        $trujillo = Ubicacion::where('slug', 'trujillo')->first();
        $ica = Ubicacion::where('slug', 'ica')->first();

        $rutaLimaCusco = Ruta::where('slug', 'lima-cusco')->first();
        $rutaLimaArequipa = Ruta::where('slug', 'lima-arequipa')->first();
        $rutaLimaPuno = Ruta::where('slug', 'lima-puno')->first();
        $rutaCuscoPuno = Ruta::where('slug', 'cusco-puno')->first();
        $rutaLimaTrujillo = Ruta::where('slug', 'lima-trujillo')->first();
        $rutaLimaIca = Ruta::where('slug', 'lima-ica')->first();

        $movilidades = Movilidad::all();

        foreach ($movilidades as $index => $movilidad) {
            switch ($index % 6) {
                case 0:
                    $movilidad->ubicaciones()->attach([
                        $lima->id,
                        $cusco->id,
                    ]);
                    $movilidad->rutas()->attach([
                        $rutaLimaCusco->id => ['precio_ruta' => 450.00],
                        $rutaCuscoPuno->id => ['precio_ruta' => 280.00],
                    ]);
                    break;

                case 1:
                    $movilidad->ubicaciones()->attach([
                        $lima->id,
                        $arequipa->id,
                    ]);
                    $movilidad->rutas()->attach([
                        $rutaLimaArequipa->id => ['precio_ruta' => 520.00],
                    ]);
                    break;

                case 2:
                    $movilidad->ubicaciones()->attach([
                        $lima->id,
                        $puno->id,
                    ]);
                    $movilidad->rutas()->attach([
                        $rutaLimaPuno->id => ['precio_ruta' => 580.00],
                    ]);
                    break;

                case 3:
                    $movilidad->ubicaciones()->attach([
                        $lima->id,
                        $trujillo->id,
                    ]);
                    $movilidad->rutas()->attach([
                        $rutaLimaTrujillo->id => ['precio_ruta' => 380.00],
                    ]);
                    break;

                case 4:
                    $movilidad->ubicaciones()->attach([
                        $lima->id,
                        $ica->id,
                    ]);
                    $movilidad->rutas()->attach([
                        $rutaLimaIca->id => ['precio_ruta' => 180.00],
                    ]);
                    break;

                case 5:
                    $movilidad->ubicaciones()->attach([
                        $lima->id,
                        $cusco->id,
                        $arequipa->id,
                    ]);
                    $movilidad->rutas()->attach([
                        $rutaLimaCusco->id => ['precio_ruta' => 480.00],
                        $rutaLimaArequipa->id => ['precio_ruta' => 550.00],
                    ]);
                    break;
            }
        }
    }
}
