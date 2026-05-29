<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modalidad;
use App\Models\Movilidad;
use App\Models\Ubicacion;
use DateTimeInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class CatalogoController extends Controller
{
    private function toTimestamp(mixed $value): int
    {
        if ($value instanceof DateTimeInterface) {
            return $value->getTimestamp();
        }

        if (is_string($value)) {
            $timestamp = strtotime($value);

            return $timestamp === false ? 0 : $timestamp;
        }

        if (is_int($value)) {
            return $value;
        }

        return 0;
    }

    private function ubicacionesExplorarCacheKey(): string
    {
        $ubicacionesVersion = (string) $this->toTimestamp(Ubicacion::max('updated_at'));

        return "catalogo:ubicaciones:explorar:v1:{$ubicacionesVersion}";
    }

    private function getUbicacionesExplorar()
    {
        return Cache::remember($this->ubicacionesExplorarCacheKey(), now()->addMinutes(15), function () {
            return Ubicacion::where('activo', true)
                ->orderBy('nombre')
                ->limit(6)
                ->get(['id', 'nombre', 'slug', 'ruta_imagen']);
        });
    }

    private function filtrosCacheKey(): string
    {
        $ubicacionesVersion = (string) $this->toTimestamp(Ubicacion::max('updated_at'));
        $movilidadesVersion = (string) $this->toTimestamp(Movilidad::max('updated_at'));
        $pivotVersion = (string) $this->toTimestamp(DB::table('movilidad_ubicacion')->max('updated_at'));

        return "catalogo:filtros:activos:v3:{$ubicacionesVersion}:{$movilidadesVersion}:{$pivotVersion}";
    }

    private function getFiltros()
    {
        return Cache::remember($this->filtrosCacheKey(), now()->addMinutes(15), function () {
            $capacidadMax = (int) Movilidad::where('activo', true)->max('capacidad_pasajeros');

            return [
                'ubicaciones' => Ubicacion::where('activo', true)
                    ->orderBy('nombre')
                    ->get(['id', 'nombre', 'slug', 'ruta_imagen']),

                'marcas' => Marca::where('activo', true)
                    ->orderBy('nombre')
                    ->get(['id', 'nombre']),

                'categorias' => \App\Models\Categoria::where('activo', true)
                    ->orderBy('orden')
                    ->pluck('nombre'),

                'pasajeros_min_opciones' => Movilidad::where('activo', true)
                    ->distinct()
                    ->orderBy('capacidad_pasajeros')
                    ->pluck('capacidad_pasajeros')
                    ->unique()
                    ->sort()
                    ->values(),

                'modalidades' => Modalidad::where('activo', true)
                    ->orderBy('nombre')
                    ->get(['id', 'nombre', 'slug']),

                'capacidad_max_flota' => max(1, $capacidadMax ?: 1),
            ];
        });
    }

    private function ordenValido(?string $orden): string
    {
        return in_array($orden, ['recientes', 'precio_asc', 'precio_desc', 'capacidad_desc'], true)
            ? $orden
            : 'recientes';
    }

    public function inicio()
    {
        $filtros = $this->getFiltros();
        $ubicacionesExplorar = $this->getUbicacionesExplorar();

        $movilidades = Movilidad::select([
            'id',
            'nombre',
            'slug',
            'marca_id',
            'categoria',
            'precio_base',
            'capacidad_pasajeros',
            'ruta_imagen',
            'activo',
        ])
            ->with(['marca:id,nombre,logo', 'ubicaciones:id,nombre', 'modalidades:id,nombre,slug', 'caracteristicas:id,nombre'])
            ->where('activo', true)
            ->latest()
            ->take(8)
            ->get();

        return view('pages.home', compact('filtros', 'movilidades', 'ubicacionesExplorar'));
    }

    public function flota(Request $request)
    {
        $query = Movilidad::select([
            'id',
            'nombre',
            'slug',
            'marca_id',
            'categoria',
            'precio_base',
            'capacidad_pasajeros',
            'ruta_imagen',
            'activo',
        ])
            ->with(['marca:id,nombre,logo', 'ubicaciones:id,nombre', 'modalidades:id,nombre,slug', 'caracteristicas:id,nombre'])
            ->where('activo', true);

        if ($request->filled('ubicacion')) {
            $query->whereHas('ubicaciones', function ($q) use ($request) {
                $q->where('ubicaciones.id', $request->ubicacion);
            });
        }

        if ($request->filled('marca')) {
            $query->where('marca_id', $request->marca);
        }

        if ($request->filled('categoria')) {
            $query->where('categoria', $request->categoria);
        }

        if ($request->filled('modalidad')) {
            $query->whereHas('modalidades', function ($q) use ($request) {
                $q->where('modalidades.slug', $request->modalidad);
            });
        }

        $filtros = $this->getFiltros();
        $capMaxFlota = max(1, (int) ($filtros['capacidad_max_flota'] ?? 1));

        $minPax = $request->filled('pasajeros_min') ? (int) $request->pasajeros_min : null;
        $maxPax = $request->filled('pasajeros_max') ? (int) $request->pasajeros_max : null;

        if ($minPax !== null && ($minPax < 1 || $minPax > $capMaxFlota)) {
            $minPax = null;
        }
        if ($maxPax !== null && ($maxPax < 1 || $maxPax > $capMaxFlota)) {
            $maxPax = null;
        }
        if ($minPax !== null && $maxPax !== null && $minPax > $maxPax) {
            [$minPax, $maxPax] = [$maxPax, $minPax];
        }

        if ($minPax !== null && $minPax <= 1) {
            $minPax = null;
        }
        if ($maxPax !== null && $maxPax >= $capMaxFlota) {
            $maxPax = null;
        }

        if ($minPax !== null) {
            $query->where('capacidad_pasajeros', '>=', $minPax);
        }
        if ($maxPax !== null) {
            $query->where('capacidad_pasajeros', '<=', $maxPax);
        }

        $orden = $this->ordenValido($request->query('orden'));
        match ($orden) {
            'precio_asc' => $query->orderBy('precio_base', 'asc')->orderBy('nombre'),
            'precio_desc' => $query->orderBy('precio_base', 'desc')->orderBy('nombre'),
            'capacidad_desc' => $query->orderBy('capacidad_pasajeros', 'desc')->orderBy('nombre'),
            default => $query->latest('movilidades.id'),
        };

        $movilidades = $query->paginate(10)->withQueryString();

        return view('pages.flota.index', compact('movilidades', 'filtros', 'orden'));
    }

    public function detalle(Movilidad $movilidad)
    {
        if (! $movilidad->activo) {
            abort(404);
        }

        $movilidad->load([
            'marca:id,nombre,logo',
            'ubicaciones:id,nombre',
            'rutas:id,nombre,origen,destino,activo',
            'modalidades:id,nombre,slug',
            'caracteristicas:id,nombre',
        ]);

        return view('pages.movilidades.show', compact('movilidad'));
    }

    public function contacto()
    {
        return view('pages.contacto');
    }
}
