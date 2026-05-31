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
        if (!is_file($ruta)) continue;
        $medidas = @getimagesize($ruta);
        $heroSlides[] = [
            'src'   => asset('img/' . $archivo),
            'ancho' => $medidas[0] ?? 1920,
            'alto'  => $medidas[1] ?? 760,
        ];
    }
    $heroTieneSlider = count($heroSlides) > 1;
@endphp

<section class="relative isolate w-full overflow-x-hidden min-h-[520px] md:min-h-[580px] bg-brand-blue flex items-center"
    aria-label="Búsqueda de hoteles en el Perú — {{ config('app.name') }}">

    {{-- Imágenes de fondo --}}
    @if(count($heroSlides) > 0)
        <div class="absolute inset-0 z-0 overflow-hidden"
            @if($heroTieneSlider) data-hero-slider data-interval-ms="5000" @endif>
            @foreach($heroSlides as $idx => $slide)
                <img src="{{ $slide['src'] }}"
                    alt="Hoteles en el Perú — {{ config('app.name') }}"
                    width="{{ $slide['ancho'] }}" height="{{ $slide['alto'] }}"
                    class="absolute inset-0 h-full w-full object-cover object-center transition-opacity duration-700"
                    style="opacity:{{ $idx === 0 ? '1' : '0' }}; z-index:{{ $idx === 0 ? '1' : '0' }};"
                    fetchpriority="{{ $idx === 0 ? 'high' : 'low' }}"
                    loading="{{ $idx === 0 ? 'eager' : 'lazy' }}"
                    decoding="async"
                    @if($heroTieneSlider) data-hero-slide @endif>
            @endforeach
            @if($heroTieneSlider)
                <div class="pointer-events-none absolute inset-x-0 bottom-6 z-[2] flex justify-center gap-2">
                    @foreach($heroSlides as $idx => $_)
                        <button type="button" data-hero-dot
                            class="pointer-events-auto h-1.5 w-6 rounded-full transition-all {{ $idx === 0 ? 'bg-white' : 'bg-white/35 w-1.5' }}"
                            aria-label="Imagen {{ $idx + 1 }}"></button>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    <div class="absolute inset-0 z-[1] bg-gradient-to-b from-black/60 via-black/45 to-black/65" aria-hidden="true"></div>

    {{-- Contenido --}}
    <div class="relative z-10 w-full max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-36 pb-14 md:pt-48 md:pb-16 text-center">

        {{-- Texto principal --}}
        <div class="mb-8 md:mb-10">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm border border-white/20 text-white/90 text-[0.68rem] font-semibold uppercase tracking-[0.18em] px-4 py-1.5 rounded-full mb-5">
                <span class="w-1.5 h-1.5 rounded-full bg-brand-yellow inline-block"></span>
                Hoteles verificados en el Perú
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-white leading-[1.1] tracking-tight mb-4 drop-shadow-lg">
                Encuentra tu hotel ideal<br>
                <span class="text-brand-yellow">al mejor precio</span>
            </h1>
            <p class="text-white/65 text-sm sm:text-base font-medium max-w-lg mx-auto">
                Cajamarca, Cusco, Lima y más destinos del Perú.
            </p>
        </div>

        {{-- ── BUSCADOR DESKTOP (lg+) ─────────────────────────── --}}
        <div class="hidden lg:block">
            <form method="GET" action="{{ route('hoteles.catalogo') }}"
                class="w-full max-w-5xl"
                data-pax-min-counter data-pax-cap="{{ $capHeroPax }}" data-hero-form>
                <input type="hidden" name="personas_min" class="hero-pax-hidden" value="{{ $paxHeroVal >= 2 ? $paxHeroVal : '' }}">

                <div class="flex items-stretch bg-white rounded-2xl shadow-xl overflow-hidden">

                    {{-- Destino --}}
                    <div class="flex-1 min-w-0 px-5 py-4 border-r border-slate-100 hover:bg-slate-50 transition-colors cursor-pointer">
                        <label for="f-destino" class="block text-[0.6rem] font-semibold text-slate-400 uppercase tracking-widest mb-1.5 cursor-pointer">Destino</label>
                        <div class="relative">
                            <select id="f-destino" name="destino"
                                class="w-full bg-transparent text-slate-800 text-sm font-semibold focus:outline-none appearance-none cursor-pointer pr-5 truncate">
                                <option value="">Todos los destinos</option>
                                @foreach($filtros['destinos'] as $destino)
                                    <option value="{{ $destino->id }}" {{ request('destino') == $destino->id ? 'selected' : '' }}>{{ $destino->nombre }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-0 top-1/2 -translate-y-1/2 w-3 h-3 text-slate-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    {{-- Marca --}}
                    <div class="flex-1 min-w-0 px-5 py-4 border-r border-slate-100 hover:bg-slate-50 transition-colors cursor-pointer">
                        <label for="f-marca" class="block text-[0.6rem] font-semibold text-slate-400 uppercase tracking-widest mb-1.5 cursor-pointer">Cadena</label>
                        <div class="relative">
                            <select id="f-marca" name="marca"
                                class="w-full bg-transparent text-slate-800 text-sm font-semibold focus:outline-none appearance-none cursor-pointer pr-5 truncate">
                                <option value="">Todas las marcas</option>
                                @foreach($filtros['marcas'] as $marca)
                                    <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-0 top-1/2 -translate-y-1/2 w-3 h-3 text-slate-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    {{-- Categoría --}}
                    <div class="flex-1 min-w-0 px-5 py-4 border-r border-slate-100 hover:bg-slate-50 transition-colors cursor-pointer">
                        <label for="f-categoria" class="block text-[0.6rem] font-semibold text-slate-400 uppercase tracking-widest mb-1.5 cursor-pointer">Estrellas</label>
                        <div class="relative">
                            <select id="f-categoria" name="categoria"
                                class="w-full bg-transparent text-slate-800 text-sm font-semibold focus:outline-none appearance-none cursor-pointer pr-5 truncate">
                                <option value="">Todas las categorías</option>
                                @foreach($filtros['categorias'] as $cat)
                                    <option value="{{ $cat }}" {{ request('categoria') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                            <svg class="absolute right-0 top-1/2 -translate-y-1/2 w-3 h-3 text-slate-300 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"/></svg>
                        </div>
                    </div>

                    {{-- Huéspedes --}}
                    <div class="px-5 py-4 border-r border-slate-100 hover:bg-slate-50 transition-colors select-none">
                        <span class="block text-[0.6rem] font-semibold text-slate-400 uppercase tracking-widest mb-1.5">Huéspedes</span>
                        <div class="flex items-center gap-2">
                            <button type="button"
                                class="w-6 h-6 rounded-full border border-slate-200 flex items-center justify-center text-slate-500 hover:border-brand-blue hover:text-brand-blue transition-colors text-sm font-bold focus:outline-none"
                                onclick="var el=this.nextElementSibling.querySelector('input'),val=Math.max(1,parseInt(el.value)-1);el.value=val;this.closest('form').querySelector('.hero-pax-hidden').value=val;this.nextElementSibling.querySelector('span').innerText=val+(val===1?' huésped':' huéspedes');">−</button>
                            <div class="text-center min-w-[90px]">
                                <input type="hidden" class="hero-pax-input" value="{{ $paxHeroVal }}">
                                <span class="text-sm font-semibold text-slate-800">{{ $paxHeroVal }} {{ $paxHeroVal === 1 ? 'huésped' : 'huéspedes' }}</span>
                            </div>
                            <button type="button"
                                class="w-6 h-6 rounded-full border border-slate-200 flex items-center justify-center text-slate-500 hover:border-brand-blue hover:text-brand-blue transition-colors text-sm font-bold focus:outline-none"
                                onclick="var el=this.previousElementSibling.querySelector('input'),val=Math.min({{ $capHeroPax }},parseInt(el.value)+1);el.value=val;this.closest('form').querySelector('.hero-pax-hidden').value=val;this.previousElementSibling.querySelector('span').innerText=val+(val===1?' huésped':' huéspedes');">+</button>
                        </div>
                    </div>

                    {{-- Botón buscar --}}
                    <div class="flex items-center px-3">
                        <button type="submit"
                            class="flex items-center gap-2 bg-brand-yellow text-brand-blue font-bold text-sm px-6 py-3 rounded-xl hover:bg-yellow-400 active:scale-[0.97] transition-all whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg>
                            Buscar
                        </button>
                    </div>

                </div>
            </form>
        </div>

        {{-- ── BUSCADOR MOBILE / TABLET (< lg) ────────────────── --}}
        <div class="lg:hidden">
            <form method="GET" action="{{ route('hoteles.catalogo') }}"
                class="bg-white rounded-2xl shadow-xl overflow-hidden"
                data-pax-min-counter data-pax-cap="{{ $capHeroPax }}" data-hero-form>
                <input type="hidden" name="personas_min" class="hero-pax-hidden" value="{{ $paxHeroVal >= 2 ? $paxHeroVal : '' }}">

                <div class="p-4 space-y-3">

                    {{-- Destino full width --}}
                    <div>
                        <label for="f-destino-m" class="block text-[0.6rem] font-semibold text-slate-400 uppercase tracking-widest mb-1">Destino</label>
                        <select id="f-destino-m" name="destino"
                            class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 appearance-none">
                            <option value="">Todos los destinos</option>
                            @foreach($filtros['destinos'] as $destino)
                                <option value="{{ $destino->id }}" {{ request('destino') == $destino->id ? 'selected' : '' }}>{{ $destino->nombre }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Cadena + Estrellas en grid --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label for="f-marca-m" class="block text-[0.6rem] font-semibold text-slate-400 uppercase tracking-widest mb-1">Cadena</label>
                            <select id="f-marca-m" name="marca"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 appearance-none">
                                <option value="">Todas</option>
                                @foreach($filtros['marcas'] as $marca)
                                    <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>{{ $marca->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="f-categoria-m" class="block text-[0.6rem] font-semibold text-slate-400 uppercase tracking-widest mb-1">Estrellas</label>
                            <select id="f-categoria-m" name="categoria"
                                class="w-full rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm font-semibold text-slate-800 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 appearance-none">
                                <option value="">Todas</option>
                                @foreach($filtros['categorias'] as $cat)
                                    <option value="{{ $cat }}" {{ request('categoria') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    {{-- Huéspedes + Botón --}}
                    <div class="flex items-center gap-3">
                        <div class="flex items-center gap-2 flex-1 rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5">
                            <button type="button"
                                class="w-6 h-6 rounded-full border border-slate-300 flex items-center justify-center text-slate-500 text-sm font-bold focus:outline-none"
                                onclick="var el=this.nextElementSibling.querySelector('input'),val=Math.max(1,parseInt(el.value)-1);el.value=val;this.closest('form').querySelector('.hero-pax-hidden').value=val;this.nextElementSibling.querySelector('span').innerText=val+(val===1?' huésped':' huéspedes');">−</button>
                            <div class="flex-1 text-center">
                                <input type="hidden" class="hero-pax-input" value="{{ $paxHeroVal }}">
                                <span class="text-sm font-semibold text-slate-800">{{ $paxHeroVal }} {{ $paxHeroVal === 1 ? 'huésped' : 'huéspedes' }}</span>
                            </div>
                            <button type="button"
                                class="w-6 h-6 rounded-full border border-slate-300 flex items-center justify-center text-slate-500 text-sm font-bold focus:outline-none"
                                onclick="var el=this.previousElementSibling.querySelector('input'),val=Math.min({{ $capHeroPax }},parseInt(el.value)+1);el.value=val;this.closest('form').querySelector('.hero-pax-hidden').value=val;this.previousElementSibling.querySelector('span').innerText=val+(val===1?' huésped':' huéspedes');">+</button>
                        </div>
                        <button type="submit"
                            class="flex items-center gap-2 bg-brand-yellow text-brand-blue font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-yellow-400 active:scale-[0.97] transition-all whitespace-nowrap">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-4.35-4.35M17 11A6 6 0 1 1 5 11a6 6 0 0 1 12 0z"/></svg>
                            Buscar
                        </button>
                    </div>

                </div>
            </form>
        </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-hero-form]').forEach(function (form) {
                form.addEventListener('submit', function (e) {
                    e.preventDefault();
                    var params = new URLSearchParams();
                    Array.from(form.elements).forEach(function (el) {
                        if (el.name && el.value && el.value !== '' && !el.disabled) {
                            params.set(el.name, el.value);
                        }
                    });
                    window.location.href = form.action + (params.toString() ? '?' + params.toString() : '');
                });
            });
        });
    </script>
</section>
