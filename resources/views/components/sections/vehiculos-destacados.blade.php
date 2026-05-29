@props(['movilidades'])

<section class="bg-slate-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="section-title mb-2">
                <span class="text-brand-blue">Vehiculos</span>
                <span class="text-brand-yellow"> Destacados</span>
            </h2>
            <p class="text-ink text-body-16 font-medium max-w-xl mx-auto">Selecciona el transporte ideal: desde vans hasta buses, con precios desde y ubicación en Cajamarca, Chiclayo y más ciudades.</p>
        </div>

        @if($movilidades->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @foreach($movilidades as $movilidad)
                    <x-movilidades.tarjeta :movilidad="$movilidad" />
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('flota') }}" class="inline-flex items-center gap-2 bg-brand-blue text-white font-bold text-ui px-8 py-3 rounded-lg hover:bg-blue-900 transition-colors shadow-sm">
                    Ver toda la flota
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>
