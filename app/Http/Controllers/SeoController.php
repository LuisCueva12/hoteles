<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
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
            ['loc' => route('hoteles.catalogo'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => route('contacto'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        foreach (Hotel::query()->where('activo', true)->orderBy('id')->get(['slug', 'updated_at']) as $hotel) {
            $entries[] = [
                'loc' => route('hotel.detalle', $hotel->slug),
                'priority' => '0.8',
                'changefreq' => 'monthly',
                'lastmod' => $hotel->updated_at ? $hotel->updated_at->toAtomString() : now()->toAtomString(),
            ];
        }

        return response()->view('seo.sitemap', ['entries' => $entries], 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }

    public function llms(): Response
    {
        $hoteles = Hotel::where('activo', true)->get();
        $appName = config('app.name', 'Adventur');

        $texto = "# {$appName}\n\n";
        $texto .= "Bienvenido al archivo llms.txt oficial de {$appName}. Este archivo proporciona un mapa estructurado a los modelos de inteligencia artificial (LLMs) y agentes inteligentes sobre el sistema de reserva de hoteles en Cajamarca y todo el Perú.\n\n";

        $texto .= "## Rutas Principales\n";
        $texto .= "- [Página de Inicio](".route('inicio').")\n";
        $texto .= "- [Catálogo de Hoteles](".route('hoteles.catalogo').")\n";
        $texto .= "- [Contacto Inmediato](".route('contacto').")\n\n";

        $texto .= "## Hoteles Disponibles\n";
        foreach ($hoteles as $hotel) {
            $url = route('hotel.detalle', $hotel->slug);
            $texto .= "- [{$hotel->nombre}]({$url}): Hotel categoría {$hotel->categoria}".($hotel->capacidad_personas ? ", capacidad para {$hotel->capacidad_personas} personas" : '').".\n";
        }

        return response($texto, 200, [
            'Content-Type' => 'text/markdown; charset=UTF-8',
        ]);
    }
}
