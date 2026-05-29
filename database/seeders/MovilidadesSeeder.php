<?php

namespace Database\Seeders;

use App\Models\Caracteristica;
use App\Models\Marca;
use App\Models\Modalidad;
use App\Models\Movilidad;
use Illuminate\Database\Seeder;

class MovilidadesSeeder extends Seeder
{
    public function run(): void
    {
        $hyundai = Marca::where('slug', 'hyundai')->first();
        $kia = Marca::where('slug', 'kia')->first();
        $toyota = Marca::where('slug', 'toyota')->first();

        $conConductor = Modalidad::where('slug', 'con_conductor')->first();
        $sinConductor = Modalidad::where('slug', 'sin_conductor')->first();

        $vehiculos = [
            [
                'nombre'              => 'Avante',
                'marca_id'            => $hyundai->id,
                'categoria'           => 'Compact',
                'precio_base'         => 43.00,
                'capacidad_pasajeros' => 5,
                'modalidades'         => [$conConductor->id, $sinConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1552519507-da3b142c6e3d?w=800&q=80',
                'caracteristicas'     => ['Kilometraje ilimitado', 'Seguro contra colisión', 'Aire acondicionado', 'GPS incluido'],
            ],
            [
                'nombre'              => 'K5',
                'marca_id'            => $kia->id,
                'categoria'           => 'Sedán',
                'precio_base'         => 23.00,
                'capacidad_pasajeros' => 5,
                'modalidades'         => [$conConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1494976388531-d1058494cdd8?w=800&q=80',
                'caracteristicas'     => ['Kilometraje ilimitado', 'Seguro por robo', 'Bluetooth', 'Cámara trasera'],
            ],
            [
                'nombre'              => 'K5 Advanced',
                'marca_id'            => $kia->id,
                'categoria'           => 'Sedán',
                'precio_base'         => 29.00,
                'capacidad_pasajeros' => 5,
                'modalidades'         => [$conConductor->id, $sinConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1580273916550-e323be2ae537?w=800&q=80',
                'caracteristicas'     => ['Kilometraje ilimitado', 'Seguro completo', 'Asientos de cuero', 'Pantalla táctil'],
            ],
            [
                'nombre'              => 'K3',
                'marca_id'            => $kia->id,
                'categoria'           => 'Compact',
                'precio_base'         => 19.00,
                'capacidad_pasajeros' => 5,
                'modalidades'         => [$sinConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1541899481282-d53bffe3c35d?w=800&q=80',
                'caracteristicas'     => ['Kilometraje ilimitado', 'Seguro básico', 'Económico en combustible'],
            ],
            [
                'nombre'              => 'EV6',
                'marca_id'            => $kia->id,
                'categoria'           => 'SUV Premium',
                'precio_base'         => 31.00,
                'capacidad_pasajeros' => 5,
                'modalidades'         => [$conConductor->id, $sinConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1519641471654-76ce0107ad1b?w=800&q=80',
                'caracteristicas'     => ['Eléctrico 100%', 'Carga rápida incluida', 'Seguro completo', 'Pantalla 12"'],
            ],
            [
                'nombre'              => 'Morning',
                'marca_id'            => $kia->id,
                'categoria'           => 'Mini',
                'precio_base'         => 18.00,
                'capacidad_pasajeros' => 4,
                'modalidades'         => [$sinConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1502877338535-766e1452684a?w=800&q=80',
                'caracteristicas'     => ['Ideal para ciudad', 'Bajo consumo', 'Fácil estacionamiento'],
            ],
            [
                'nombre'              => 'Hiace Commuter',
                'marca_id'            => $toyota->id,
                'categoria'           => 'Van de Pasajeros',
                'precio_base'         => 120.00,
                'capacidad_pasajeros' => 14,
                'modalidades'         => [$conConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&q=80',
                'caracteristicas'     => ['14 pasajeros', 'Aire acondicionado', 'Conductor incluido', 'Seguro SOAT'],
            ],
            [
                'nombre'              => 'Coaster',
                'marca_id'            => $toyota->id,
                'categoria'           => 'Minibús Turístico',
                'precio_base'         => 280.00,
                'capacidad_pasajeros' => 26,
                'modalidades'         => [$conConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?w=800&q=80',
                'caracteristicas'     => ['26 pasajeros', 'Reclinables', 'Conductor + Guía', 'WiFi a bordo'],
            ],
            [
                'nombre'              => 'Land Cruiser 200',
                'marca_id'            => $toyota->id,
                'categoria'           => 'SUV Premium',
                'precio_base'         => 380.00,
                'capacidad_pasajeros' => 8,
                'modalidades'         => [$conConductor->id],
                'activo'              => true,
                'ruta_imagen'         => 'https://images.unsplash.com/photo-1527515637462-cff94eecc1ac?w=800&q=80',
                'caracteristicas'     => ['Tracción 4x4', 'Ideal para desierto', 'Conductor experto', 'Refrigerador a bordo'],
            ],
        ];

        foreach ($vehiculos as $v) {
            $modalidadIds = $v['modalidades'];
            $caracteristicasNombres = $v['caracteristicas'];
            unset($v['modalidades'], $v['caracteristicas']);

            $movilidad = Movilidad::firstOrCreate(['nombre' => $v['nombre'], 'marca_id' => $v['marca_id']], $v);
            $movilidad->modalidades()->syncWithoutDetaching($modalidadIds);

            $caracteristicaIds = collect($caracteristicasNombres)->map(
                fn (string $nombre) => Caracteristica::firstOrCreate(['nombre' => $nombre])->id
            )->all();
            $movilidad->caracteristicas()->syncWithoutDetaching($caracteristicaIds);
        }
    }
}
