<?php

namespace App\Providers;

use App\Models\Configuracion;
use App\Models\Marca;
use App\Models\Hotel;
use App\Models\Destino;
use App\Observers\MarcaObserver;
use App\Observers\HotelObserver;
use App\Observers\DestinoObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('esAdmin', function ($user) {
            return $user->esAdmin();
        });

        if (!\Illuminate\Support\Facades\Schema::hasTable('configuraciones')) {
            return;
        }

        $configContacto = Configuracion::obtenerConfiguracion();
        $whatsappDigitos = preg_replace('/\D+/', '', (string) $configContacto->telefono_whatsapp);
        $whatsappTextoPrefill = urlencode('Hola, quiero reservar o consultar por un hotel.');
        $whatsappReservaUrl = $whatsappDigitos !== ''
            ? 'https://wa.me/'.$whatsappDigitos.'?text='.$whatsappTextoPrefill
            : '#';

        View::share([
            'telefonoAtencionHref' => $configContacto->enlaceTelefono(),
            'telefonoAtencionEtiqueta' => $configContacto->etiquetaTelefonoLegible(),
            'whatsappReservaUrl' => $whatsappReservaUrl,
            'enlaceFacebook' => $configContacto->enlace_facebook,
            'enlaceInstagram' => $configContacto->enlace_instagram,
        ]);

        if (\Illuminate\Support\Facades\Schema::hasTable('hoteles')) {
            Hotel::observe(HotelObserver::class);
        }
        
        Marca::observe(MarcaObserver::class);
        
        if (\Illuminate\Support\Facades\Schema::hasTable('destinos')) {
            Destino::observe(DestinoObserver::class);
        }
    }
}
