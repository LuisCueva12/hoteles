@props(['filtros'])

@php
    $capHeroPax = max(1, (int) ($filtros['capacidad_max_flota'] ?? 50));
    $paxHeroVal = 1;
    if (request()->filled('pasajeros_min')) {
        $v = (int) request('pasajeros_min');
        if ($v >= 2 && $v <= $capHeroPax) {
            $paxHeroVal = $v;
        }
    }
    $heroArchivos = ['hero-principal-2.webp', 'hero-principal.webp'];
    $heroSlides = [];
    foreach ($heroArchivos as $archivo) {
        $ruta = public_path('img/' . $archivo);
        if (!is_file($ruta)) {
            continue;
        }
        $medidas = @getimagesize($ruta);
        $heroSlides[] = [
            'src' => asset('img/' . $archivo),
            'ancho' => $medidas[0] ?? 1920,
            'alto' => $medidas[1] ?? 760,
        ];
    }
    $heroTieneSlider = count($heroSlides) > 1;
@endphp

<section class="relative isolate w-full overflow-x-hidden min-h-[280px] bg-brand-blue md:min-h-[320px]"
    aria-label="Búsqueda de movilidades: alquiler de vehículos con chofer en Cajamarca y Perú, {{ config('app.name') }}.">
    @if (count($heroSlides) > 0)
        <div class="absolute inset-0 z-0 overflow-hidden"
            @if ($heroTieneSlider) role="region" aria-label="Carrusel de imágenes del banner" data-hero-slider data-interval-ms="5000" @endif>
            @foreach ($heroSlides as $idx => $slide)
                <img src="{{ $slide['src'] }}"
                    alt="@if ($heroTieneSlider) Imagen {{ $idx + 1 }} de {{ count($heroSlides) }} del hero — @endif Movilidades y traslados en carretera en el Perú: alquiler con chofer profesional en Cajamarca y todo el país con {{ config('app.name') }}."
                    title="@if ($heroTieneSlider) Imagen {{ $idx + 1 }} de {{ count($heroSlides) }} del hero — @endif Movilidades y traslados en carretera en el Perú: alquiler con chofer profesional en Cajamarca y todo el país con {{ config('app.name') }}."
                    width="{{ $slide['ancho'] }}" height="{{ $slide['alto'] }}"
                    class="absolute inset-0 h-full w-full object-cover object-center transition-opacity duration-700 ease-in-out"
                    style="opacity: {{ $idx === 0 ? '1' : '0' }}; z-index: {{ $idx === 0 ? '1' : '0' }};"
                    aria-hidden="{{ $idx === 0 ? 'false' : 'true' }}"
                    @if ($heroTieneSlider) data-hero-slide @endif
                    fetchpriority="{{ $idx === 0 ? 'high' : 'low' }}" loading="{{ $idx === 0 ? 'eager' : 'lazy' }}"
                    decoding="async">
            @endforeach
            @if ($heroTieneSlider)

                <div class="pointer-events-none absolute inset-x-0 bottom-4 z-[2] flex justify-center gap-2 md:bottom-6"
                    role="tablist" aria-label="Cambiar imagen del hero">
                    @foreach ($heroSlides as $idx => $_)
                        <button type="button" role="tab" data-hero-dot
                            class="pointer-events-auto h-2 w-2 rounded-full transition-colors md:h-2.5 md:w-2.5 {{ $idx === 0 ? 'bg-white' : 'bg-white/50' }}"
                            aria-label="Ver imagen {{ $idx + 1 }}"
                            aria-selected="{{ $idx === 0 ? 'true' : 'false' }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
    <div class="pointer-events-none absolute inset-0 z-[1] bg-brand-blue/60 md:bg-transparent md:bg-gradient-to-r md:from-brand-blue/95 md:via-brand-blue/40 md:to-transparent"
        aria-hidden="true"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-14 pb-10 md:pt-20 md:pb-14 w-full">
        <div class="text-left mb-10 xl:mb-12 max-w-3xl">
            <div
                class="inline-flex items-center gap-1.5 bg-brand-yellow text-ink-strong text-[0.65rem] md:text-xs font-bold uppercase tracking-wider px-3 md:px-4 py-1.5 md:py-2 rounded-r-lg rounded-tl-lg mb-5 shadow-sm">
                Transporte Turístico y Corporativo
            </div>

            <h1
                class="text-3xl sm:text-4xl lg:text-[2.85rem] font-extrabold text-white leading-[1.15] tracking-tight mb-4 drop-shadow-md">
                Movilidad que te lleva <br class="hidden sm:block"> más lejos, con <br class="hidden sm:block"> <span
                    class="text-brand-yellow">seguridad y confianza</span>
            </h1>

            <p class="text-white/90 text-[0.95rem] sm:text-base md:text-lg max-w-2xl font-medium mb-8 drop-shadow">
                Servicio de alquiler de movilidades con chofer profesional en Cajamarca y todo el Perú.
            </p>

            <div class="flex flex-col sm:flex-row flex-wrap gap-3 sm:gap-4 mb-8">
                <div
                    class="flex-1 flex items-center gap-3 bg-brand-blue/80 backdrop-blur-md border border-white/10 rounded-xl px-4 py-3 shadow-lg hover:border-brand-yellow/50 transition-colors">
                    <x-dynamic-component :component="'lucide-car'" class="w-6 h-6 text-brand-yellow shrink-0"
                        stroke-width="2.5" />
                    <div class="flex flex-col">
                        <span class="text-white font-bold text-sm leading-tight">Flota moderna</span>
                        <span class="text-white/70 text-xs">Unidades 2020 en adelante</span>
                    </div>
                </div>
                <div
                    class="flex-1 flex items-center gap-3 bg-brand-blue/80 backdrop-blur-md border border-white/10 rounded-xl px-4 py-3 shadow-lg hover:border-brand-yellow/50 transition-colors">
                    <x-dynamic-component :component="'lucide-users'" class="w-6 h-6 text-brand-yellow shrink-0"
                        stroke-width="2.5" />
                    <div class="flex flex-col">
                        <span class="text-white font-bold text-sm leading-tight">Choferes profesionales</span>
                        <span class="text-white/70 text-xs">Puntualidad garantizada</span>
                    </div>
                </div>
                <div
                    class="flex-1 flex items-center gap-3 bg-brand-blue/80 backdrop-blur-md border border-white/10 rounded-xl px-4 py-3 shadow-lg hover:border-brand-yellow/50 transition-colors">
                    <x-dynamic-component :component="'lucide-headset'" class="w-6 h-6 text-brand-yellow shrink-0"
                        stroke-width="2.5" />
                    <div class="flex flex-col">
                        <span class="text-white font-bold text-sm leading-tight">Atención 24/7</span>
                        <span class="text-white/70 text-xs">Soporte inmediato</span>
                    </div>
                </div>
            </div>


            <div class="flex items-center gap-4">
                <div class="flex -space-x-2.5">
                    <img class="w-9 h-9 rounded-full border-2 border-brand-blue object-cover opacity-90 grayscale-[20%]"
                        src="{{ asset('avatars/100.jpg') }}" alt="Cliente José Saavedra" title="José Saavedra">
                    <img class="w-9 h-9 rounded-full border-2 border-brand-blue object-cover opacity-90 grayscale-[20%]"
                        src="{{ asset('avatars/101.jpg') }}" alt="Cliente">
                    <img class="w-9 h-9 rounded-full border-2 border-brand-blue object-cover opacity-90 grayscale-[20%]"
                        src="{{ asset('avatars/102.jpg') }}" alt="Cliente">
                    <img class="w-9 h-9 rounded-full border-2 border-brand-blue object-cover opacity-90 grayscale-[20%]"
                        src="{{ asset('avatars/103.jpg') }}" alt="Cliente">
                </div>
                <div class="flex flex-col">
                    <span class="text-white/90 text-xs font-medium">Más de 500 clientes satisfechos</span>
                    <div class="flex items-center gap-1.5 mt-0.5">
                        <div class="flex text-brand-yellow">
                            <x-dynamic-component :component="'lucide-star'" class="w-3.5 h-3.5 fill-current" stroke-width="2" />
                            <x-dynamic-component :component="'lucide-star'" class="w-3.5 h-3.5 fill-current" stroke-width="2" />
                            <x-dynamic-component :component="'lucide-star'" class="w-3.5 h-3.5 fill-current" stroke-width="2" />
                            <x-dynamic-component :component="'lucide-star'" class="w-3.5 h-3.5 fill-current" stroke-width="2" />
                            <x-dynamic-component :component="'lucide-star'" class="w-3.5 h-3.5 fill-current" stroke-width="2" />
                        </div>
                        <span class="text-white font-bold text-[0.7rem]">4.9/5 en Google</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- DESKTOP FILTER BAR                                     --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="hidden lg:block" data-hero-desktop>
            <form method="GET" action="{{ route('flota') }}" class="w-full max-w-6xl mx-auto" data-pax-min-counter
                data-pax-cap="{{ $capHeroPax }}" data-hero-form>
                <input type="hidden" name="pasajeros_min" class="hero-pax-hidden"
                    value="{{ $paxHeroVal >= 2 ? $paxHeroVal : '' }}">

                <div
                    class="flex items-stretch rounded-2xl bg-white/[0.97] backdrop-blur-xl shadow-2xl shadow-black/20 ring-1 ring-white/20 p-1.5 transition-shadow hover:shadow-black/25">
                    <div class="flex-1 grid min-w-0 grid-cols-4 divide-x divide-slate-200/70">

                        <div
                            class="group min-w-0 px-4 py-3 rounded-xl transition-colors hover:bg-slate-50/80 cursor-pointer">
                            <label for="f-ubicacion"
                                class="flex items-center gap-1.5 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1 cursor-pointer">
                                <x-dynamic-component :component="'lucide-navigation'" class="w-3 h-3 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Ubicación
                            </label>
                            <div class="relative">
                                <select id="f-ubicacion" name="ubicacion"
                                    class="bg-transparent text-ink-strong text-[0.9375rem] font-semibold focus:outline-none appearance-none cursor-pointer w-full min-w-0 py-0.5 pr-5 truncate">
                                    <option value="">Todas las ciudades</option>
                                    @foreach ($filtros['ubicaciones'] as $ubicacion)
                                        <option value="{{ $ubicacion->id }}"
                                            {{ request('ubicacion') == $ubicacion->id ? 'selected' : '' }}>
                                            {{ $ubicacion->nombre }}</option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-0 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <div
                            class="group min-w-0 px-4 py-3 rounded-xl transition-colors hover:bg-slate-50/80 cursor-pointer">
                            <label for="f-marca"
                                class="flex items-center gap-1.5 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1 cursor-pointer">
                                <x-dynamic-component :component="'lucide-badge-check'" class="w-3 h-3 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Marca
                            </label>
                            <div class="relative">
                                <select id="f-marca" name="marca"
                                    class="bg-transparent text-ink-strong text-[0.9375rem] font-semibold focus:outline-none appearance-none cursor-pointer w-full min-w-0 py-0.5 pr-5 truncate">
                                    <option value="">Todas las marcas</option>
                                    @foreach ($filtros['marcas'] as $marca)
                                        <option value="{{ $marca->id }}"
                                            {{ request('marca') == $marca->id ? 'selected' : '' }}>
                                            {{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-0 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <div
                            class="group min-w-0 px-4 py-3 rounded-xl transition-colors hover:bg-slate-50/80 cursor-pointer">
                            <label for="f-categoria"
                                class="flex items-center gap-1.5 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1 cursor-pointer">
                                <x-dynamic-component :component="'lucide-layers'" class="w-3 h-3 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Categoría
                            </label>
                            <div class="relative">
                                <select id="f-categoria" name="categoria"
                                    class="bg-transparent text-ink-strong text-[0.9375rem] font-semibold focus:outline-none appearance-none cursor-pointer w-full min-w-0 py-0.5 pr-5 truncate">
                                    <option value="">Todos los tipos</option>
                                    @foreach ($filtros['categorias'] as $cat)
                                        <option value="{{ $cat }}"
                                            {{ request('categoria') === $cat ? 'selected' : '' }}>{{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="absolute right-0 top-1/2 -translate-y-1/2 w-3.5 h-3.5 text-slate-400 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>

                        <div class="min-w-0 px-4 py-3 rounded-xl transition-colors hover:bg-slate-50/80">
                            <x-movilidades.pasajeros-contador-campo :cap-max="$capHeroPax" :count="$paxHeroVal"
                                class="[&_.text-label-upper]:text-[0.65rem] [&_.text-label-upper]:tracking-[0.14em] [&_.text-label-upper]:text-brand-blue/60 [&_.text-label-upper]:font-bold" />
                        </div>
                    </div>

                    <div class="flex shrink-0 items-center gap-2 pl-3 pr-1">
                        <button type="button" data-hero-clear
                            class="flex items-center justify-center gap-2 text-xs font-bold text-slate-500 hover:text-brand-blue px-3 h-11 rounded-xl transition-colors whitespace-nowrap border border-transparent hover:border-slate-200 hover:bg-slate-50 cursor-pointer focus:outline-none">
                            <x-dynamic-component :component="'lucide-rotate-ccw'" class="w-3.5 h-3.5" stroke-width="2.5" />
                            Limpiar
                        </button>
                        <button type="submit"
                            class="group/btn flex items-center justify-center gap-2 bg-brand-yellow text-brand-blue font-bold text-sm h-11 px-7 rounded-xl hover:bg-yellow-400 active:scale-[0.97] transition-all whitespace-nowrap shadow-md shadow-brand-yellow/20">
                            <x-dynamic-component :component="'lucide-search'"
                                class="w-4 h-4 transition-transform group-hover/btn:scale-110" stroke-width="2.5" />
                            Buscar
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- MOBILE FILTER                                          --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="lg:hidden" data-hero-mobile>
            <form method="GET" action="{{ route('flota') }}"
                class="rounded-2xl bg-white/[0.97] backdrop-blur-xl shadow-2xl shadow-black/20 ring-1 ring-white/20 overflow-hidden"
                data-pax-min-counter data-pax-cap="{{ $capHeroPax }}" data-hero-form>
                <input type="hidden" name="pasajeros_min" class="hero-pax-hidden"
                    value="{{ $paxHeroVal >= 2 ? $paxHeroVal : '' }}">

                <details class="group" open>
                    <summary
                        class="flex items-center justify-center gap-2 cursor-pointer list-none px-4 py-3 [&::-webkit-details-marker]:hidden select-none active:bg-slate-50/60 transition-colors">
                        <div class="flex items-center justify-center w-7 h-7 rounded-lg bg-brand-blue/10">
                            <x-dynamic-component :component="'lucide-search'" class="w-3.5 h-3.5 text-brand-blue"
                                stroke-width="2.5" />
                        </div>
                        <span class="text-brand-blue text-sm font-bold">
                            Buscar movilidad
                        </span>
                        <x-dynamic-component :component="'lucide-chevron-down'"
                            class="w-3.5 h-3.5 text-brand-blue/40 shrink-0 transition-transform duration-200 group-open:rotate-180"
                            stroke-width="2.5" />
                    </summary>

                    <div class="border-t border-slate-100 px-3 pb-3 pt-2.5 space-y-2.5">
                        <div>
                            <label for="f-ubicacion-mobile"
                                class="flex items-center gap-1.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1">
                                <x-dynamic-component :component="'lucide-navigation'" class="w-2.5 h-2.5 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Ubicación
                            </label>
                            <select id="f-ubicacion-mobile" name="ubicacion"
                                class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-ink-strong focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue/40 transition-shadow appearance-none">
                                <option value="">Todas las ciudades</option>
                                @foreach ($filtros['ubicaciones'] as $ubicacion)
                                    <option value="{{ $ubicacion->id }}"
                                        {{ request('ubicacion') == $ubicacion->id ? 'selected' : '' }}>
                                        {{ $ubicacion->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-2.5">
                            <div>
                                <label for="f-marca-mobile"
                                    class="flex items-center gap-1.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1">
                                    <x-dynamic-component :component="'lucide-badge-check'" class="w-2.5 h-2.5 text-brand-blue/50"
                                        stroke-width="2.5" />
                                    Marca
                                </label>
                                <select id="f-marca-mobile" name="marca"
                                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-ink-strong focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue/40 transition-shadow appearance-none">
                                    <option value="">Todas</option>
                                    @foreach ($filtros['marcas'] as $marca)
                                        <option value="{{ $marca->id }}"
                                            {{ request('marca') == $marca->id ? 'selected' : '' }}>
                                            {{ $marca->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="f-categoria-mobile"
                                    class="flex items-center gap-1.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1">
                                    <x-dynamic-component :component="'lucide-layers'" class="w-2.5 h-2.5 text-brand-blue/50"
                                        stroke-width="2.5" />
                                    Categoría
                                </label>
                                <select id="f-categoria-mobile" name="categoria"
                                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-ink-strong focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue/40 transition-shadow appearance-none">
                                    <option value="">Todos</option>
                                    @foreach ($filtros['categorias'] as $cat)
                                        <option value="{{ $cat }}"
                                            {{ request('categoria') === $cat ? 'selected' : '' }}>{{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2.5">
                            <x-movilidades.pasajeros-contador-campo :cap-max="$capHeroPax" :count="$paxHeroVal"
                                class="[&_.text-label-upper]:text-[0.6rem] [&_.text-label-upper]:tracking-[0.14em] [&_.text-label-upper]:text-brand-blue/60 [&_.text-label-upper]:font-bold" />
                        </div>

                        <div class="flex gap-2">
                            <button type="button" data-hero-clear
                                class="flex items-center justify-center gap-1.5 border border-slate-200 bg-white text-slate-500 hover:text-brand-blue hover:border-brand-blue/30 font-bold text-xs h-11 px-4 rounded-xl transition-all shadow-sm cursor-pointer focus:outline-none">
                                <x-dynamic-component :component="'lucide-rotate-ccw'" class="w-3.5 h-3.5" stroke-width="2.5" />
                                Limpiar
                            </button>
                            <button type="submit"
                                class="flex-1 flex items-center justify-center gap-2 bg-brand-yellow text-brand-blue font-bold text-sm h-11 rounded-xl hover:bg-yellow-400 active:scale-[0.98] transition-all shadow-md shadow-brand-yellow/20">
                                <x-dynamic-component :component="'lucide-search'" class="w-4 h-4" stroke-width="2.5" />
                                Buscar
                            </button>
                        </div>
                    </div>
                </details>
            </form>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('[data-hero-clear]').forEach(function(btn) {
                    btn.addEventListener('click', function() {
                        var form = this.closest('form');
                        if (!form) return;

                        form.querySelectorAll('select').forEach(function(select) {
                            select.value = '';
                        });

                        var paxInput = form.querySelector('.hero-pax-input');
                        if (paxInput) {
                            paxInput.value = '1';
                            paxInput.dispatchEvent(new Event('change', {
                                bubbles: true
                            }));
                        }
                    });
                });

                document.querySelectorAll('[data-hero-form]').forEach(function(form) {
                    form.addEventListener('submit', function(e) {
                        e.preventDefault();
                        var params = new URLSearchParams();
                        var elements = form.elements;
                        for (var i = 0; i < elements.length; i++) {
                            var el = elements[i];
                            if (el.name && el.value && el.value !== '' && !el.disabled) {
                                params.set(el.name, el.value);
                            }
                        }
                        window.location.href = form.action + (params.toString() ? '?' + params
                            .toString() : '');
                    });
                });
            });
        </script>
    </div>
</section>
