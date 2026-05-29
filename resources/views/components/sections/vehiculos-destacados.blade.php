@props(['hoteles'])

<section class="bg-slate-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="section-title mb-2">
                <span class="text-brand-blue">Hoteles y Alojamientos</span>
                <span class="text-brand-yellow"> Destacados</span>
            </h2>
            <p class="text-ink text-body-16 font-medium max-w-xl mx-auto">Selecciona el hotel ideal: desde resorts de lujo hasta hoteles boutique con todas las comodidades en Cajamarca, Cusco, Lima y más destinos.</p>
        </div>

        @if($hoteles && $hoteles->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                @foreach($hoteles as $hotel)
                    <x-hoteles.tarjeta :hotel="$hotel" />
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('hoteles.catalogo') }}" class="inline-flex items-center gap-2 bg-brand-blue text-white font-bold text-ui px-8 py-3 rounded-lg hover:bg-blue-900 transition-colors shadow-sm">
                    Ver todos los hoteles
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </a>
            </div>
        @endif
    </div>
</section>
