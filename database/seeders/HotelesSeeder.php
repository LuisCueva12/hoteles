<?php

namespace Database\Seeders;

use App\Models\Caracteristica;
use App\Models\Marca;
use App\Models\Modalidad;
use App\Models\Hotel;
use App\Models\Destino;
use Illuminate\Database\Seeder;

class HotelesSeeder extends Seeder
{
    public function run(): void
    {
        $casaAndina = Marca::where('slug', 'casa-andina')->first();
        $hilton = Marca::where('slug', 'hilton')->first();
        $marriott = Marca::where('slug', 'marriott')->first();
        $sonesta = Marca::where('slug', 'sonesta')->first();

        $soloHabitacion = Modalidad::firstOrCreate(['slug' => 'solo_habitacion'], ['nombre' => 'Solo Habitación', 'activo' => true]);
        $todoIncluido = Modalidad::firstOrCreate(['slug' => 'todo_incluido'], ['nombre' => 'Todo Incluido', 'activo' => true]);

        $hoteles = [
            [
                'nombre'              => 'Casa Andina Premium Cusco',
                'marca_id'            => $casaAndina->id,
                'categoria'           => '5 Estrellas',
                'precio_base'         => 180.00,
                'capacidad_personas' => 4,
                'modalidades'         => [$soloHabitacion->id],
                'destinos'            => ['cusco', 'valle-sagrado'],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&q=80',
                'caracteristicas'     => ['WiFi Gratis', 'Desayuno Buffet', 'Calefacción', 'Spa', 'Oxígeno en habitación'],
            ],
            [
                'nombre'              => 'Casa Andina Standard Cajamarca',
                'marca_id'            => $casaAndina->id,
                'categoria'           => '3 Estrellas',
                'precio_base'         => 75.00,
                'capacidad_personas' => 3,
                'modalidades'         => [$soloHabitacion->id],
                'destinos'            => ['cajamarca'],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?w=800&q=80',
                'caracteristicas'     => ['WiFi Gratis', 'Ducha Española', 'Tv Cable', 'Restaurante'],
            ],
            [
                'nombre'              => 'Hilton Garden Inn Lima Miraflores',
                'marca_id'            => $hilton->id,
                'categoria'           => '4 Estrellas',
                'precio_base'         => 120.00,
                'capacidad_personas' => 2,
                'modalidades'         => [$soloHabitacion->id, $todoIncluido->id],
                'destinos'            => ['lima', 'miraflores'],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1596394516093-501ba68a0ba6?w=800&q=80',
                'caracteristicas'     => ['Piscina Rooftop', 'Gimnasio', 'Bar', 'Estacionamiento Gratis'],
            ],
            [
                'nombre'              => 'Sonesta Posadas del Inca Cusco',
                'marca_id'            => $sonesta->id,
                'categoria'           => '4 Estrellas',
                'precio_base'         => 95.00,
                'capacidad_personas' => 3,
                'modalidades'         => [$soloHabitacion->id],
                'destinos'            => ['cusco'],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?w=800&q=80',
                'caracteristicas'     => ['Calefacción', 'Restaurante Turístico', 'Jardín Colonial', 'Asistencia médica'],
            ]
        ];

        foreach ($hoteles as $h) {
            $modalidadIds = $h['modalidades'];
            $destinoSlugs = $h['destinos'];
            $caracteristicasNombres = $h['caracteristicas'];
            unset($h['modalidades'], $h['destinos'], $h['caracteristicas']);

            $hotel = Hotel::firstOrCreate(['nombre' => $h['nombre'], 'marca_id' => $h['marca_id']], $h);
            $hotel->modalidades()->syncWithoutDetaching($modalidadIds);

            // Sync Destinations
            $destinoIds = Destino::whereIn('slug', $destinoSlugs)->pluck('id')->all();
            $hotel->destinos()->syncWithoutDetaching($destinoIds);

            // Sync Characteristics
            $caracteristicaIds = collect($caracteristicasNombres)->map(
                fn (string $nombre) => Caracteristica::firstOrCreate(['nombre' => $nombre], ['slug' => \Illuminate\Support\Str::slug($nombre)])->id
            )->all();
            $hotel->caracteristicas()->syncWithoutDetaching($caracteristicaIds);
        }
    }
}
