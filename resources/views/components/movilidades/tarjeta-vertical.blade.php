@props(['movilidad'])

<article
    class="bg-white rounded-2xl overflow-hidden flex flex-col group border border-brand-blue/10 transition-all duration-300 shadow-sm hover:shadow-xl hover:-translate-y-0.5">
    <div class="relative h-52 w-full overflow-hidden bg-slate-100">
        @if ($movilidad->tiene_imagen)
            <img src="{{ $movilidad->imagen_url }}" alt="{{ $movilidad->nombre }}"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center text-brand-blue/35" aria-hidden="true">
                <x-dynamic-component :component="'lucide-car'" class="w-14 h-14" stroke-width="1.5" />
            </div>
        @endif
        <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-brand-blue/65 via-brand-blue/20 to-transparent"
            aria-hidden="true"></div>
        <div
            class="absolute top-3 left-3 bg-brand-yellow text-brand-blue px-3 py-1.5 rounded-lg shadow-sm ring-1 ring-brand-blue/15">
            <p class="text-[11px] font-medium uppercase tracking-wide leading-none">Desde</p>
            <p class="text-[1.35rem] font-semibold mt-0.5 leading-none">
                S/{{ number_format($movilidad->precio_base, 0) }}</p>
        </div>
        @if ($movilidad->marca && $movilidad->marca->tiene_logo)
            <div class="absolute right-3 bottom-3 bg-white/90 rounded-md px-2 py-1 shadow-sm">
                <img src="{{ $movilidad->marca->logo_url }}" alt="{{ $movilidad->marca->nombre }}"
                    class="h-6 w-auto max-w-[84px] object-contain shrink-0">
            </div>
        @endif
    </div>

    <div class="p-5 flex flex-col flex-grow">
        <div class="mb-4 space-y-2">
            <div class="flex items-center justify-center gap-2 text-ink min-h-7">
                <x-dynamic-component :component="'lucide-users-round'" class="w-5 h-5 text-brand-blue" stroke-width="2" />
                <p class="text-[1.02rem] leading-none font-medium text-ink-strong">Hasta
                    {{ $movilidad->capacidad_pasajeros }} pasajeros</p>
            </div>

            <h3 class="text-[1.45rem] leading-tight font-semibold text-ink-strong line-clamp-1 text-center">
                {{ $movilidad->nombre }}
            </h3>

            <div class="flex flex-wrap items-center gap-2">
                <span
                    class="inline-flex items-center gap-1 rounded-full bg-brand-blue/10 text-brand-blue text-caption font-medium px-2.5 py-1">
                    <x-dynamic-component :component="'lucide-tag'" class="w-3.5 h-3.5" />
                    {{ $movilidad->capital_categoria }}
                </span>
                @foreach ($movilidad->modalidades as $modalidad)
                    <span
                        class="inline-flex items-center gap-1 rounded-full bg-brand-blue/10 text-brand-blue text-caption font-medium px-2.5 py-1">
                        <x-dynamic-component :component="'lucide-car-front'" class="w-3.5 h-3.5" />
                        {{ $modalidad->nombre }}
                    </span>
                @endforeach
            </div>

            <div class="flex items-center gap-1 text-brand-yellow" aria-hidden="true">
                @for ($i = 0; $i < 5; $i++)
                    <x-dynamic-component :component="'lucide-star'" class="w-4 h-4 fill-current" stroke-width="1.8" />
                @endfor
            </div>
        </div>

        <div class="flex items-center gap-2 mb-5 text-ink min-w-0">
            <span
                class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-brand-blue/10 text-brand-blue shrink-0"
                aria-hidden="true">
                <x-dynamic-component :component="'lucide-map-pinned'" class="w-5 h-5" stroke-width="2" />
            </span>
            <p class="text-[0.98rem] font-medium leading-snug break-words text-ink-strong">
                Ubicado en: {{ $movilidad->ubicaciones->pluck('nombre')->join(', ') ?: 'Múltiples ubicaciones' }}
            </p>
        </div>

        <div class="mt-auto">
            <a href="{{ route('movilidad.detalle', $movilidad->slug) }}"
                class="w-full h-11 inline-flex items-center justify-center gap-2 bg-brand-yellow text-brand-blue font-semibold text-ui px-4 rounded-xl hover:bg-yellow-400 transition-colors text-center">
                Reservar ahora
                <x-dynamic-component :component="'lucide-arrow-right'" class="w-4 h-4" stroke-width="2.5" />
            </a>
        </div>
    </div>
</article>
