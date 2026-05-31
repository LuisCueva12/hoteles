@props(['hotel'])

<article class="group bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 flex flex-col">

    {{-- Imagen principal --}}
    <a href="{{ route('hotel.detalle', $hotel->slug) }}" class="relative block aspect-[4/3] overflow-hidden shrink-0">
        @if($hotel->tiene_imagen)
            <img
                src="{{ $hotel->imagen_url }}"
                alt="{{ $hotel->nombre }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700 ease-out"
                loading="lazy"
                decoding="async"
            >
        @else
            <div class="w-full h-full bg-slate-100 flex items-center justify-center text-slate-300">
                <x-dynamic-component :component="'lucide-hotel'" class="w-16 h-16" stroke-width="1" />
            </div>
        @endif

        {{-- Gradient overlay bottom --}}
        <div class="absolute inset-0 bg-gradient-to-t from-black/75 via-black/15 to-transparent" aria-hidden="true"></div>

        {{-- Precio badge - top left --}}
        <div class="absolute top-3 left-3 bg-brand-yellow text-brand-blue px-3 py-1.5 rounded-xl shadow-lg">
            <p class="text-[10px] font-semibold uppercase tracking-wide leading-none">Desde</p>
            <p class="text-[1.1rem] font-black leading-tight">S/{{ number_format($hotel->precio_base, 0) }}<span class="text-[10px] font-semibold">/noche</span></p>
        </div>

        {{-- Logo marca - top right --}}
        @if($hotel->marca && $hotel->marca->tiene_logo)
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm rounded-lg px-2 py-1 shadow">
                <img src="{{ $hotel->marca->logo_url }}" alt="{{ $hotel->marca->nombre }}" class="h-5 w-auto max-w-[72px] object-contain">
            </div>
        @endif

        {{-- Nombre + categoría sobre imagen --}}
        <div class="absolute bottom-0 left-0 right-0 p-4">
            <div class="flex items-center gap-1.5 mb-1">
                <span class="inline-flex items-center gap-1 bg-white/20 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full">
                    <x-dynamic-component :component="'lucide-star'" class="w-3 h-3 fill-brand-yellow text-brand-yellow" stroke-width="1.5" />
                    {{ $hotel->capital_categoria }}
                </span>
                @foreach($hotel->modalidades->take(1) as $modalidad)
                    <span class="inline-flex items-center gap-1 bg-white/20 backdrop-blur-sm text-white text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full">
                        {{ $modalidad->nombre }}
                    </span>
                @endforeach
            </div>
            <h3 class="text-white font-bold text-lg leading-snug line-clamp-2 drop-shadow-sm">
                {{ $hotel->nombre }}
            </h3>
        </div>
    </a>

    {{-- Info strip --}}
    <div class="px-4 py-3 flex items-center justify-between gap-3 border-t border-slate-100">
        <div class="flex items-center gap-1.5 min-w-0">
            <x-dynamic-component :component="'lucide-map-pin'" class="w-3.5 h-3.5 text-brand-blue shrink-0" stroke-width="2" />
            <p class="text-sm text-slate-600 font-medium truncate">
                {{ $hotel->destinos->pluck('nombre')->take(2)->join(', ') ?: 'Perú' }}
            </p>
        </div>
        <div class="flex items-center gap-1 shrink-0 text-slate-400">
            <x-dynamic-component :component="'lucide-users'" class="w-3.5 h-3.5" stroke-width="2" />
            <span class="text-xs font-medium">{{ $hotel->capacidad_personas }} pers.</span>
        </div>
    </div>

    {{-- CTA --}}
    <div class="px-4 pb-4">
        <a href="{{ route('hotel.detalle', $hotel->slug) }}"
            class="w-full inline-flex items-center justify-center gap-2 bg-brand-blue text-white font-semibold text-sm py-2.5 rounded-xl hover:bg-blue-900 transition-colors group/btn">
            Ver Hotel
            <x-dynamic-component :component="'lucide-arrow-right'" class="w-4 h-4 group-hover/btn:translate-x-0.5 transition-transform" stroke-width="2.5" />
        </a>
    </div>

</article>
