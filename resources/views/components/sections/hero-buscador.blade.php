@props(['filtros'])

@php
    $capHeroPax = max(1, (int) ($filtros['capacidad_max_hoteles'] ?? 50));
    $paxHeroVal = 1;
    if (request()->filled('personas_min')) {
        $v = (int) request('personas_min');
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
    aria-label="Búsqueda de hoteles: reserva de alojamiento verificado en Cajamarca y Perú, {{ config('app.name') }}.">
    @if (count($heroSlides) > 0)
        <div class="absolute inset-0 z-0 overflow-hidden"
            @if ($heroTieneSlider) role="region" aria-label="Carrusel de imágenes del banner" data-hero-slider data-interval-ms="5000" @endif>
            @foreach ($heroSlides as $idx => $slide)
                <img src="{{ $slide['src'] }}"
                    alt="@if ($heroTieneSlider) Imagen {{ $idx + 1 }} de {{ count($heroSlides) }} del hero — @endif Hoteles y alojamientos en el Perú: reserva directa por WhatsApp con {{ config('app.name') }}."
                    title="@if ($heroTieneSlider) Imagen {{ $idx + 1 }} de {{ count($heroSlides) }} del hero — @endif Hoteles y alojamientos en el Perú: reserva directa por WhatsApp con {{ config('app.name') }}."
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

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-32 pb-10 md:pt-44 lg:pt-48 md:pb-14 w-full">
        <div class="text-left mb-10 xl:mb-12 max-w-3xl">

            <h1
                class="text-3xl sm:text-4xl lg:text-[2.85rem] font-extrabold text-white leading-[1.15] tracking-tight mb-4 drop-shadow-md">
                Encuentra tu hotel ideal <br class="hidden sm:block"> con tarifas justas, <br class="hidden sm:block"> <span
                    class="text-brand-yellow">seguridad y confianza</span>
            </h1>

            <p class="text-white/90 text-[0.95rem] sm:text-base md:text-lg max-w-2xl font-medium mb-8 drop-shadow">
                Reserva de hoteles y habitaciones verificadas en Cajamarca, Cusco, Lima y las principales ciudades del Perú.
            </p>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- DESKTOP FILTER BAR                                     --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="hidden lg:block" data-hero-desktop>
            <form method="GET" action="{{ route('hoteles.catalogo') }}" class="w-full max-w-6xl mx-auto" data-pax-min-counter
                data-pax-cap="{{ $capHeroPax }}" data-hero-form>
                <input type="hidden" name="personas_min" class="hero-pax-hidden"
                    value="{{ $paxHeroVal >= 2 ? $paxHeroVal : '' }}">

                <div
                    class="flex items-stretch rounded-2xl bg-white/[0.97] backdrop-blur-xl shadow-2xl shadow-black/20 ring-1 ring-white/20 p-1.5 transition-shadow hover:shadow-black/25">
                    <div class="flex-1 grid min-w-0 grid-cols-4 divide-x divide-slate-200/70">

                        <div
                            class="group min-w-0 px-4 py-3 rounded-xl transition-colors hover:bg-slate-50/80 cursor-pointer">
                            <label for="f-destino"
                                class="flex items-center gap-1.5 text-[0.65rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1 cursor-pointer">
                                <x-dynamic-component :component="'lucide-map-pin'" class="w-3 h-3 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Destino
                            </label>
                            <div class="relative">
                                <select id="f-destino" name="destino"
                                    class="bg-transparent text-ink-strong text-[0.9375rem] font-semibold focus:outline-none appearance-none cursor-pointer w-full min-w-0 py-0.5 pr-5 truncate">
                                    <option value="">Todos los destinos</option>
                                    @foreach ($filtros['destinos'] as $destino)
                                        <option value="{{ $destino->id }}"
                                            {{ request('destino') == $destino->id ? 'selected' : '' }}>
                                            {{ $destino->nombre }}</option>
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
                                <x-dynamic-component :component="'lucide-award'" class="w-3 h-3 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Cadena / Marca
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
                                <x-dynamic-component :component="'lucide-star'" class="w-3 h-3 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Estrellas
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
                            <div class="flex flex-col select-none">
                                <span class="text-[0.65rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1 flex items-center gap-1">
                                    <x-dynamic-component :component="'lucide-users'" class="w-3 h-3 text-brand-blue/50" stroke-width="2.5" />
                                    Huéspedes
                                </span>
                                <div class="flex items-center gap-3">
                                    <button type="button" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center font-bold text-ink focus:outline-none border-0 cursor-pointer active:scale-95 transition-all" onclick="var el = this.nextElementSibling.querySelector('input'); var val = Math.max(1, parseInt(el.value) - 1); el.value = val; this.closest('form').querySelector('.hero-pax-hidden').value = val; this.nextElementSibling.querySelector('span').innerText = val + ' huéspedes';">
                                        -
                                    </button>
                                    <div class="min-w-[80px] text-center font-semibold text-ink-strong text-sm">
                                        <input type="hidden" class="hero-pax-input" value="{{ $paxHeroVal }}">
                                        <span>{{ $paxHeroVal }} huéspedes</span>
                                    </div>
                                    <button type="button" class="w-7 h-7 rounded-full bg-slate-100 hover:bg-slate-200 flex items-center justify-center font-bold text-ink focus:outline-none border-0 cursor-pointer active:scale-95 transition-all" onclick="var el = this.previousElementSibling.querySelector('input'); var val = Math.min({{ $capHeroPax }}, parseInt(el.value) + 1); el.value = val; this.closest('form').querySelector('.hero-pax-hidden').value = val; this.previousElementSibling.querySelector('span').innerText = val + ' huéspedes';">
                                        +
                                    </button>
                                </div>
                            </div>
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
                            Buscar Hotel
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- ═══════════════════════════════════════════════════════ --}}
        {{-- MOBILE FILTER                                          --}}
        {{-- ═══════════════════════════════════════════════════════ --}}
        <div class="lg:hidden" data-hero-mobile>
            <form method="GET" action="{{ route('hoteles.catalogo') }}"
                class="rounded-2xl bg-white/[0.97] backdrop-blur-xl shadow-2xl shadow-black/20 ring-1 ring-white/20 overflow-hidden"
                data-pax-min-counter data-pax-cap="{{ $capHeroPax }}" data-hero-form>
                <input type="hidden" name="personas_min" class="hero-pax-hidden"
                    value="{{ $paxHeroVal >= 2 ? $paxHeroVal : '' }}">

                <details class="group" open>
                    <summary
                        class="flex items-center justify-center gap-2 cursor-pointer list-none px-4 py-3 [&::-webkit-details-marker]:hidden select-none active:bg-slate-50/60 transition-colors">
                        <div class="flex items-center justify-center w-7 h-7 rounded-lg bg-brand-blue/10">
                            <x-dynamic-component :component="'lucide-search'" class="w-3.5 h-3.5 text-brand-blue"
                                stroke-width="2.5" />
                        </div>
                        <span class="text-brand-blue text-sm font-bold">
                            Buscar alojamiento
                        </span>
                        <x-dynamic-component :component="'lucide-chevron-down'"
                            class="w-3.5 h-3.5 text-brand-blue/40 shrink-0 transition-transform duration-200 group-open:rotate-180"
                            stroke-width="2.5" />
                    </summary>

                    <div class="border-t border-slate-100 px-3 pb-3 pt-2.5 space-y-2.5">
                        <div>
                            <label for="f-destino-mobile"
                                class="flex items-center gap-1.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1">
                                <x-dynamic-component :component="'lucide-map-pin'" class="w-2.5 h-2.5 text-brand-blue/50"
                                    stroke-width="2.5" />
                                Destino
                            </label>
                            <select id="f-destino-mobile" name="destino"
                                class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-ink-strong focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue/40 transition-shadow appearance-none">
                                <option value="">Todos los destinos</option>
                                @foreach ($filtros['destinos'] as $destino)
                                    <option value="{{ $destino->id }}"
                                        {{ request('destino') == $destino->id ? 'selected' : '' }}>
                                        {{ $destino->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-2.5">
                            <div>
                                <label for="f-marca-mobile"
                                    class="flex items-center gap-1.5 text-[0.6rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1">
                                    <x-dynamic-component :component="'lucide-award'" class="w-2.5 h-2.5 text-brand-blue/50"
                                        stroke-width="2.5" />
                                    Cadena
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
                                    <x-dynamic-component :component="'lucide-star'" class="w-2.5 h-2.5 text-brand-blue/50"
                                        stroke-width="2.5" />
                                    Estrellas
                                </label>
                                <select id="f-categoria-mobile" name="categoria"
                                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2 text-sm font-semibold text-ink-strong focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue/40 transition-shadow appearance-none">
                                    <option value="">Todas</option>
                                    @foreach ($filtros['categorias'] as $cat)
                                        <option value="{{ $cat }}"
                                            {{ request('categoria') === $cat ? 'selected' : '' }}>{{ $cat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2.5">
                            <div class="flex flex-col select-none">
                                <span class="text-[0.6rem] font-bold uppercase tracking-[0.14em] text-brand-blue/60 mb-1 flex items-center gap-1">
                                    <x-dynamic-component :component="'lucide-users'" class="w-2.5 h-2.5 text-brand-blue/50" stroke-width="2.5" />
                                    Huéspedes
                                </span>
                                <div class="flex items-center justify-between">
                                    <button type="button" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center font-bold text-ink cursor-pointer" onclick="var el = this.nextElementSibling.querySelector('input'); var val = Math.max(1, parseInt(el.value) - 1); el.value = val; this.closest('form').querySelector('.hero-pax-hidden').value = val; this.nextElementSibling.querySelector('span').innerText = val + ' huéspedes';">
                                        -
                                    </button>
                                    <div class="text-center font-semibold text-ink-strong text-sm">
                                        <input type="hidden" class="hero-pax-input" value="{{ $paxHeroVal }}">
                                        <span>{{ $paxHeroVal }} huéspedes</span>
                                    </div>
                                    <button type="button" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center font-bold text-ink cursor-pointer" onclick="var el = this.previousElementSibling.querySelector('input'); var val = Math.min({{ $capHeroPax }}, parseInt(el.value) + 1); el.value = val; this.closest('form').querySelector('.hero-pax-hidden').value = val; this.previousElementSibling.querySelector('span').innerText = val + ' huéspedes';">
                                        +
                                    </button>
                                </div>
                            </div>
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
