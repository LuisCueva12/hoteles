<x-layouts.web
    :title="$hotel->nombre . ' | ' . config('app.name')"
    :description="'Reserva en ' . $hotel->nombre . ', hotel ' . $hotel->categoria . ' en el Perú. Capacidad para ' . $hotel->capacidad_personas . ' huéspedes. Alojamiento verificado con atención directa.'"
    :image="$hotel->imagen_url">

{{-- Hero con imagen del hotel --}}
<section class="relative isolate w-full overflow-hidden bg-brand-blue -mt-[108px] md:-mt-[128px] min-h-[320px] md:min-h-[380px] flex items-end">
    @if($hotel->tiene_imagen)
        <img
            src="{{ $hotel->imagen_url }}"
            alt="{{ $hotel->nombre }}"
            class="absolute inset-0 w-full h-full object-cover object-center"
            loading="eager"
            decoding="async"
        >
    @else
        <div class="absolute inset-0 bg-brand-blue" aria-hidden="true"></div>
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-brand-blue/30" aria-hidden="true"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8 pb-10 pt-[140px] md:pt-[160px]">
        <div class="flex flex-wrap items-center gap-2 mb-3">
            <span class="inline-flex items-center gap-1.5 bg-brand-yellow text-brand-blue text-xs font-bold uppercase tracking-wide px-3 py-1 rounded-full">
                <x-dynamic-component :component="'lucide-star'" class="w-3 h-3" stroke-width="2.5" />
                {{ $hotel->capital_categoria }}
            </span>
            @foreach($hotel->destinos->take(2) as $destino)
                <span class="inline-flex items-center gap-1 bg-white/20 backdrop-blur-sm text-white text-xs font-semibold px-3 py-1 rounded-full">
                    <x-dynamic-component :component="'lucide-map-pin'" class="w-3 h-3" stroke-width="2" />
                    {{ $destino->nombre }}
                </span>
            @endforeach
        </div>
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold text-white leading-tight tracking-tight drop-shadow-lg">
            {{ $hotel->nombre }}
        </h1>
        @if($hotel->marca)
            <p class="text-white/60 text-sm mt-2 font-medium">{{ $hotel->marca->nombre }}</p>
        @endif
    </div>
</section>

<div class="bg-white min-h-screen py-10 md:py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <x-hoteles.detalle :hotel="$hotel" />
    </div>
</div>

</x-layouts.web>
