<?php

namespace App\Providers;

use App\Models\Configuracion;
use App\Models\Marca;
use App\Models\Movilidad;
use App\Models\Ubicacion;
use App\Observers\MarcaObserver;
use App\Observers\MovilidadObserver;
use App\Observers\UbicacionObserver;
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

        $configContacto = Configuracion::obtenerConfiguracion();
        $whatsappDigitos = preg_replace('/\D+/', '', (string) $configContacto->telefono_whatsapp);
        $whatsappTextoPrefill = urlencode('Hola, quiero reservar o consultar por una movilidad.');
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

        Movilidad::observe(MovilidadObserver::class);
        Marca::observe(MarcaObserver::class);
        Ubicacion::observe(UbicacionObserver::class);
    }
}
