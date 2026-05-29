<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use App\Models\Modalidad;
use App\Models\Hotel;
use App\Models\Destino;
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

    private function destinosExplorarCacheKey(): string
    {
        $destinosVersion = (string) $this->toTimestamp(Destino::max('updated_at'));

        return "catalogo:destinos:explorar:v1:{$destinosVersion}";
    }

    private function getDestinosExplorar()
    {
        return Cache::remember($this->destinosExplorarCacheKey(), now()->addMinutes(15), function () {
            return Destino::where('activo', true)
                ->orderBy('nombre')
                ->limit(6)
                ->get(['id', 'nombre', 'slug', 'imagen_url']);
        });
    }

    private function filtrosCacheKey(): string
    {
        $destinosVersion = (string) $this->toTimestamp(Destino::max('updated_at'));
        $hotelesVersion = (string) $this->toTimestamp(Hotel::max('updated_at'));
        $pivotVersion = (string) $this->toTimestamp(DB::table('hotel_destino')->max('updated_at'));

        return "catalogo:filtros:activos:v3:{$destinosVersion}:{$hotelesVersion}:{$pivotVersion}";
    }

    private function getFiltros()
    {
        return Cache::remember($this->filtrosCacheKey(), now()->addMinutes(15), function () {
            $capacidadMax = (int) Hotel::where('activo', true)->max('capacidad_personas');

            return [
                'destinos' => Destino::where('activo', true)
                    ->orderBy('nombre')
                    ->get(['id', 'nombre', 'slug', 'imagen_url']),

                'marcas' => Marca::where('activo', true)
                    ->orderBy('nombre')
                    ->get(['id', 'nombre']),

                'categorias' => \App\Models\Categoria::where('activo', true)
                    ->orderBy('orden')
                    ->pluck('nombre'),

                'personas_min_opciones' => Hotel::where('activo', true)
                    ->distinct()
                    ->orderBy('capacidad_personas')
                    ->pluck('capacidad_personas')
                    ->unique()
                    ->sort()
                    ->values(),

                'modalidades' => Modalidad::where('activo', true)
                    ->orderBy('nombre')
                    ->get(['id', 'nombre', 'slug']),

                'capacidad_max_hoteles' => max(1, $capacidadMax ?: 1),
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
        $destinosExplorar = $this->getDestinosExplorar();

        $hoteles = Hotel::select([
            'id',
            'nombre',
            'slug',
            'marca_id',
            'categoria',
            'precio_base',
            'capacidad_personas',
            'ruta_imagen',
            'activo',
        ])
            ->with(['marca:id,nombre,logo', 'destinos:id,nombre', 'modalidades:id,nombre,slug', 'caracteristicas:id,nombre'])
            ->where('activo', true)
            ->latest()
            ->take(8)
            ->get();

        return view('pages.home', compact('filtros', 'hoteles', 'destinosExplorar'));
    }

    public function catalogo(Request $request)
    {
        $query = Hotel::select([
            'id',
            'nombre',
            'slug',
            'marca_id',
            'categoria',
            'precio_base',
            'capacidad_personas',
            'ruta_imagen',
            'activo',
        ])
            ->with(['marca:id,nombre,logo', 'destinos:id,nombre', 'modalidades:id,nombre,slug', 'caracteristicas:id,nombre'])
            ->where('activo', true);

        if ($request->filled('destino')) {
            $query->whereHas('destinos', function ($q) use ($request) {
                $q->where('destinos.id', $request->destino);
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
        $capMaxHoteles = max(1, (int) ($filtros['capacidad_max_hoteles'] ?? 1));

        $minPax = $request->filled('personas_min') ? (int) $request->personas_min : null;
        $maxPax = $request->filled('personas_max') ? (int) $request->personas_max : null;

        if ($minPax !== null && ($minPax < 1 || $minPax > $capMaxHoteles)) {
            $minPax = null;
        }
        if ($maxPax !== null && ($maxPax < 1 || $maxPax > $capMaxHoteles)) {
            $maxPax = null;
        }
        if ($minPax !== null && $maxPax !== null && $minPax > $maxPax) {
            [$minPax, $maxPax] = [$maxPax, $minPax];
        }

        if ($minPax !== null && $minPax <= 1) {
            $minPax = null;
        }
        if ($maxPax !== null && $maxPax >= $capMaxHoteles) {
            $maxPax = null;
        }

        if ($minPax !== null) {
            $query->where('capacidad_personas', '>=', $minPax);
        }
        if ($maxPax !== null) {
            $query->where('capacidad_personas', '<=', $maxPax);
        }

        $orden = $this->ordenValido($request->query('orden'));
        match ($orden) {
            'precio_asc' => $query->orderBy('precio_base', 'asc')->orderBy('nombre'),
            'precio_desc' => $query->orderBy('precio_base', 'desc')->orderBy('nombre'),
            'capacidad_desc' => $query->orderBy('capacidad_personas', 'desc')->orderBy('nombre'),
            default => $query->latest('hoteles.id'),
        };

        $hoteles = $query->paginate(10)->withQueryString();

        return view('pages.hoteles-catalogo.index', compact('hoteles', 'filtros', 'orden'));
    }

    public function detalle(Hotel $hotel)
    {
        if (! $hotel->activo) {
            abort(404);
        }

        $hotel->load([
            'marca:id,nombre,logo',
            'destinos:id,nombre',
            'modalidades:id,nombre,slug',
            'caracteristicas:id,nombre',
        ]);

        return view('pages.hoteles.show', compact('hotel'));
    }

    public function contacto()
    {
        return view('pages.contacto');
    }
}
