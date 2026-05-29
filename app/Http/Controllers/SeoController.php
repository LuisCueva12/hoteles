<?php

namespace App\Http\Controllers;

use App\Models\Movilidad;
use Illuminate\Http\Response;

class SeoController extends Controller
{
    public function robots(): Response
    {
        $lines = [
            'User-agent: *',
            'Allow: /',
            '',
            'Disallow: /admin',
            'Disallow: /login',
            '',
            'Sitemap: '.url('/sitemap.xml'),
        ];

        return response(implode("\n", $lines), 200, [
            'Content-Type' => 'text/plain; charset=UTF-8',
        ]);
    }

    public function sitemap(): Response
    {
        $entries = [
            ['loc' => route('inicio'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => route('flota'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('contacto'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        foreach (Movilidad::query()->where('activo', true)->orderBy('id')->get(['slug', 'updated_at']) as $movilidad) {
            $entries[] = [
                'loc' => route('movilidad.detalle', $movilidad->slug),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => $movilidad->updated_at ? $movilidad->updated_at->toAtomString() : now()->toAtomString(),
            ];
        }

        return response()->view('seo.sitemap', ['entries' => $entries], 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    public function llms(): Response
    {
        $movilidades = Movilidad::where('activo', true)->get();
        $appName = config('app.name', 'Movilidades App');
        
        $texto = "# {$appName}\n\n";
        $texto .= "Bienvenido al archivo llms.txt oficial de {$appName}. Este archivo proporciona un mapa estructurado a los modelos de inteligencia artificial (LLMs) y agentes inteligentes sobre el sistema de reserva y alquiler de movilidades con chofer profesional en Cajamarca y Perú.\n\n";
        
        $texto .= "## Rutas Principales\n";
        $texto .= "- [Página de Inicio](".route('inicio').")\n";
        $texto .= "- [Catálogo de la Flota](".route('flota').")\n";
        $texto .= "- [Contacto Inmediato](".route('contacto').")\n\n";
        
        $texto .= "## Catálogo de Vehículos Activos\n";
        foreach ($movilidades as $m) {
            $nombreUrl = route('movilidad.detalle', $m->slug);
            $texto .= "- [{$m->nombre}]({$nombreUrl}): Transporte tipo {$m->categoria} ".($m->capacidad_pasajeros ? 'con capacidad para '.$m->capacidad_pasajeros.' pasajeros' : '').".\n";
        }

        return response($texto, 200, [
            'Content-Type' => 'text/markdown; charset=UTF-8',
        ]);
    }
}
