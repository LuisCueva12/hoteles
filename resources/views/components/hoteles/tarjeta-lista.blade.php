@props(['hotel'])

@php
    $departamento = $hotel->destinos->first()?->departamento ?? 'Perú';
    $caracteristicas = is_array($hotel->caracteristicas) ? array_slice($hotel->caracteristicas, 0, 3) : [];
    $descripcion = count($caracteristicas) > 0
        ? implode(', ', $caracteristicas) . '.'
        : match(true) {
            str_contains($hotel->categoria, '5')        => 'Lujo y exclusividad en cada detalle. Experiencias únicas con spa, restaurante gourmet y vistas privilegiadas.',
            str_contains($hotel->categoria, '4')        => 'Confort superior con instalaciones modernas y atención personalizada en un entorno privilegiado.',
            str_contains($hotel->categoria, 'Boutique') => 'Alojamiento exclusivo con carácter propio, diseño cuidado y una atención íntima y personalizada.',
            str_contains($hotel->categoria, 'Resort')   => 'Complejo con piscina, actividades recreativas y espacios para desconectarte y disfrutar en familia.',
            default                                      => 'Habitaciones cómodas, ubicación privilegiada y atención de calidad para una estadía perfecta en el Perú.',
        };
@endphp

<article class="group flex flex-col sm:flex-row gap-8 lg:gap-12 border-b border-slate-100 last:border-0 py-10 first:pt-0">

    {{-- Imagen --}}
    <a href="{{ route('hotel.detalle', $hotel->slug) }}" class="sm:w-[45%] shrink-0 block overflow-hidden rounded-xl">
        <div class="aspect-[4/3] overflow-hidden rounded-xl">
            @if($hotel->tiene_imagen)
                <img
                    src="{{ $hotel->imagen_url }}"
                    alt="{{ $hotel->nombre }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                    loading="lazy"
                    decoding="async"
                >
            @else
                <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-200">
                    <x-dynamic-component :component="'lucide-hotel'" class="w-16 h-16" stroke-width="1" />
                </div>
            @endif
        </div>
    </a>

    {{-- Contenido --}}
    <div class="flex flex-col justify-center sm:w-[55%]">

        <p class="text-[0.68rem] font-bold uppercase tracking-[0.2em] text-slate-400 mb-3">
            {{ strtoupper($departamento) }}
        </p>

        <h3 class="text-xl sm:text-2xl font-bold text-slate-900 leading-snug mb-4 group-hover:text-brand-blue transition-colors duration-300">
            <a href="{{ route('hotel.detalle', $hotel->slug) }}">{{ $hotel->nombre }}</a>
        </h3>

        <p class="text-slate-500 text-sm leading-relaxed mb-6 line-clamp-3">
            {{ $descripcion }}
        </p>

        <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-6 text-sm text-slate-500">
            <span class="flex items-center gap-1.5">
                <x-dynamic-component :component="'lucide-tag'" class="w-3.5 h-3.5 text-brand-blue shrink-0" stroke-width="2" />
                Desde <span class="font-semibold text-slate-700 ml-0.5">S/{{ number_format($hotel->precio_base, 0) }}</span>/noche
            </span>
            <span class="text-slate-200">|</span>
            <span class="flex items-center gap-1.5">
                <x-dynamic-component :component="'lucide-users'" class="w-3.5 h-3.5 text-brand-blue shrink-0" stroke-width="2" />
                {{ $hotel->capacidad_personas }} personas
            </span>
            <span class="text-slate-200">|</span>
            <span class="flex items-center gap-1.5">
                <x-dynamic-component :component="'lucide-star'" class="w-3.5 h-3.5 text-brand-blue shrink-0" stroke-width="2" />
                {{ $hotel->capital_categoria }}
            </span>
        </div>

        <div>
            <a href="{{ route('hotel.detalle', $hotel->slug) }}"
                class="inline-flex items-center gap-2 bg-brand-blue text-white font-bold text-[0.7rem] uppercase tracking-[0.15em] px-7 py-3 rounded-full hover:bg-blue-900 transition-colors duration-300">
                Descubrir
            </a>
        </div>

    </div>

</article>
