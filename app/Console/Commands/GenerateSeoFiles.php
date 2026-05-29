<?php

namespace App\Console\Commands;

use App\Models\Movilidad;
use Illuminate\Console\Command;

class GenerateSeoFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-seo-files';

    protected $description = 'Genera archivos estáticos de sitemap.xml, robots.txt y llms.txt';

    public function handle()
    {
        $this->info('Iniciando generación de archivos SEO...');

        // 1. Robots.txt
        $robots = "User-agent: *\nAllow: /\n\nDisallow: /admin\nDisallow: /login\n\nSitemap: ".url('/sitemap.xml');
        file_put_contents(public_path('robots.txt'), $robots);
        $this->line('✅ robots.txt generado.');

        // 2. Sitemap.xml
        $movilidades = Movilidad::where('activo', true)->get();
        $sitemap = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
        $sitemap .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";

        // Rutas estáticas
        $routes = [
            ['loc' => url('/'), 'priority' => '1.0', 'changefreq' => 'weekly'],
            ['loc' => url('/flota'), 'priority' => '0.9', 'changefreq' => 'weekly'],
            ['loc' => url('/contacto'), 'priority' => '0.8', 'changefreq' => 'monthly'],
        ];

        foreach ($routes as $route) {
            $sitemap .= "    <url>\n";
            $sitemap .= "        <loc>{$route['loc']}</loc>\n";
            $sitemap .= "        <changefreq>{$route['changefreq']}</changefreq>\n";
            $sitemap .= "        <priority>{$route['priority']}</priority>\n";
            $sitemap .= "    </url>\n";
        }

        // Rutas dinámicas
        foreach ($movilidades as $m) {
            $lastmod = $m->updated_at ? $m->updated_at->toAtomString() : now()->toAtomString();
            $sitemap .= "    <url>\n";
            $sitemap .= '        <loc>'.url('/movilidad/'.$m->slug)."</loc>\n";
            $sitemap .= "        <lastmod>{$lastmod}</lastmod>\n";
            $sitemap .= "        <changefreq>monthly</changefreq>\n";
            $sitemap .= "        <priority>0.8</priority>\n";
            $sitemap .= "    </url>\n";
        }
        $sitemap .= '</urlset>';
        file_put_contents(public_path('sitemap.xml'), $sitemap);
        $this->line('✅ sitemap.xml generado.');

        // 3. llms.txt
        $appName = config('app.name', 'Movilidades App');
        $llms = "# {$appName}\n\n";
        $llms .= "Bienvenido al archivo llms.txt oficial. Este archivo proporciona un mapa estructurado a los modelos de inteligencia artificial (LLMs) sobre el sistema de reserva y alquiler de movilidades.\n\n";
        $llms .= "## Rutas Principales\n";
        $llms .= '- [Página de Inicio]('.url('/').")\n";
        $llms .= '- [Catálogo de la Flota]('.url('/flota').")\n";
        $llms .= '- [Contacto Inmediato]('.url('/contacto').")\n\n";
        $llms .= "## Catálogo de Vehículos Activos\n";
        foreach ($movilidades as $m) {
            $llms .= "- [{$m->nombre}](".url('/movilidad/'.$m->slug).'): '.($m->categoria ?? 'Transporte').' con capacidad para '.($m->capacidad_pasajeros ?? 'varios')." pasajeros.\n";
        }
        file_put_contents(public_path('llms.txt'), $llms);
        $this->line('✅ llms.txt generado.');

        $this->info('Todos los archivos SEO han sido actualizados en la carpeta public/.');
    }
}
