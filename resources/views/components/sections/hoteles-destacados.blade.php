@props(['hoteles'])

@if($hoteles && $hoteles->count() > 0)
@php
    $items = $hoteles->values();
    $total = $items->count();
@endphp

<section class="relative overflow-hidden bg-[#07090f] min-h-[760px] flex flex-col" aria-label="Hoteles destacados">

    {{-- Fondo --}}
    <img src="{{ asset('img/cta-descubre-peru.png') }}" alt="" aria-hidden="true"
        class="absolute inset-0 w-full h-full object-cover object-center opacity-30 pointer-events-none scale-105">
    <div class="absolute inset-0 pointer-events-none"
        style="background: linear-gradient(to bottom, #07090f 0%, transparent 20%, transparent 75%, #07090f 100%)"></div>
    <div class="absolute inset-0 pointer-events-none"
        style="background: linear-gradient(to right, #07090f 0%, transparent 15%, transparent 85%, #07090f 100%)"></div>

    <div class="relative z-10 flex flex-col flex-1 pt-14 pb-10">

        {{-- Header centrado --}}
        <div class="text-center px-6 mb-12">
            <p class="text-white/30 text-[0.6rem] font-semibold uppercase tracking-[0.25em] mb-3">Selección especial</p>
            <h2 class="text-white text-2xl sm:text-3xl md:text-4xl font-bold tracking-tight mb-4">
                Hoteles <span class="text-brand-yellow">Destacados</span>
            </h2>
            <a href="{{ route('hoteles.catalogo') }}"
                class="inline-flex items-center gap-2 text-white/35 hover:text-white/70 text-[0.6rem] font-bold uppercase tracking-[0.22em] transition-colors duration-300">
                Ver todos los hoteles &nbsp;→
            </a>
        </div>

        {{-- Carrusel --}}
        <div class="relative flex-1 overflow-hidden" id="fs-viewport">
            <div id="fs-track"
                class="flex items-stretch absolute top-0 left-0 h-full"
                style="will-change: transform;">

                @foreach($items as $idx => $hotel)
                @php
                    $car  = is_array($hotel->caracteristicas) ? array_slice($hotel->caracteristicas, 0, 2) : [];
                    $desc = count($car) > 0
                        ? implode(' · ', $car)
                        : match(true) {
                            str_contains($hotel->categoria, '5')        => 'Lujo y exclusividad en cada detalle. Experiencias únicas con spa y restaurante gourmet.',
                            str_contains($hotel->categoria, '4')        => 'Confort superior con atención personalizada en un entorno privilegiado.',
                            str_contains($hotel->categoria, 'Boutique') => 'Alojamiento con diseño exclusivo y atención íntima y personalizada.',
                            default                                      => 'Habitaciones verificadas y atención de calidad en los mejores destinos del Perú.',
                        };
                    $dpto = $hotel->destinos->first()?->departamento ?? 'Perú';
                @endphp

                <div class="fs-card relative cursor-pointer flex-shrink-0 h-full"
                    data-idx="{{ $idx }}"
                    onclick="fsSetActive({{ $idx }})">

                    {{-- COLAPSADA --}}
                    <div class="fs-collapsed absolute inset-0 flex items-center justify-center border-r border-white/8 hover:bg-white/[0.03] transition-all duration-300"
                        style="transition: opacity 0.4s;">
                        <p class="text-white/50 text-[0.56rem] font-medium uppercase tracking-[0.12em] text-center leading-relaxed px-3">
                            {{ $hotel->nombre }}
                        </p>
                    </div>

                    {{-- EXPANDIDA: JS controla display/opacity --}}
                    <div class="fs-expanded absolute inset-0 bg-white rounded-2xl shadow-2xl overflow-hidden mx-1"
                        style="display:none; opacity:0; pointer-events:none; flex-direction:column; transition:opacity 0.3s;">

                        {{-- Top: destino + nombre --}}
                        <div class="px-5 pt-5 pb-3 shrink-0 border-b border-slate-50">
                            <p class="text-[0.55rem] font-semibold uppercase tracking-[0.22em] text-slate-400 mb-1">{{ strtoupper($dpto) }}</p>
                            <h3 class="text-slate-800 font-semibold text-[1rem] leading-snug mb-0.5 line-clamp-2">{{ $hotel->nombre }}</h3>
                            <p class="text-[0.6rem] text-slate-400 font-medium uppercase tracking-wide">{{ $hotel->capital_categoria }}</p>
                        </div>

                        {{-- Imagen altura fija --}}
                        <div class="mx-3 mt-2 mb-2 overflow-hidden rounded-xl shrink-0" style="height: 220px;">
                            @if($hotel->tiene_imagen)
                                <img src="{{ $hotel->imagen_url }}" alt="{{ $hotel->nombre }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                    <svg class="w-10 h-10 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5"/>
                                    </svg>
                                </div>
                            @endif
                        </div>

                        {{-- Bottom: desc + precio + CTA --}}
                        <div class="px-5 pb-4 pt-2 shrink-0">
                            <p class="text-slate-400 text-[0.7rem] italic leading-relaxed line-clamp-2 mb-3">{{ $desc }}</p>
                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <p class="text-[0.52rem] text-slate-400 font-medium uppercase tracking-wide mb-0.5">Desde</p>
                                    <p class="text-brand-blue font-bold text-base leading-none">S/{{ number_format($hotel->precio_base, 0) }}<span class="text-xs font-normal text-slate-400">/noche</span></p>
                                </div>
                                <a href="{{ route('hotel.detalle', $hotel->slug) }}"
                                    class="inline-flex items-center gap-2 bg-slate-900 text-white font-semibold text-[0.58rem] uppercase tracking-[0.15em] px-4 py-2 rounded-full hover:bg-brand-blue transition-colors duration-300">
                                    Ver propiedad
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
        </div>

        {{-- Navegación --}}
        <div class="flex items-center justify-center gap-8 mt-10 px-6">
            <button id="fs-prev" onclick="fsPrev()"
                class="w-10 h-10 rounded-full border border-white/15 text-white/40 hover:border-white/50 hover:text-white flex items-center justify-center transition-all duration-300">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7"/></svg>
            </button>

            {{-- Dots --}}
            <div class="flex items-center gap-2" id="fs-dots">
                @for($i = 0; $i < $total; $i++)
                    <button onclick="fsSetActive({{ $i }})"
                        class="fs-dot rounded-full transition-all duration-500 {{ $i === 0 ? 'bg-brand-yellow w-6 h-1.5' : 'bg-white/25 w-1.5 h-1.5 hover:bg-white/50' }}">
                    </button>
                @endfor
            </div>

            <button id="fs-next" onclick="fsNext()"
                class="w-10 h-10 rounded-full border border-white/15 text-white/40 hover:border-white/50 hover:text-white flex items-center justify-center transition-all duration-300">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            </button>
        </div>

    </div>
</section>

<style>
    #fs-viewport { height: 540px; }

    .fs-card {
        height: 520px;
        width: 130px;
        transition: width 0.65s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .fs-card.fs-active { width: 310px; }

    @media (min-width: 768px) {
        #fs-viewport { height: 560px; }
        .fs-card      { height: 540px; width: 150px; }
        .fs-card.fs-active { width: 340px; }
    }

    /* El JS controla display y opacity — aquí solo transiciones */
    .fs-collapsed { transition: opacity 0.3s ease; }
    .fs-expanded  { transition: opacity 0.3s ease; }
</style>

<script>
(function () {
    var active  = 0;
    var total   = {{ $total }};
    var timer   = null;
    var rafId   = null;
    var ANIM_MS = 700; // ≥ transición CSS de width (0.65s)

    /* ── helpers ───────────────────────────── */
    function getTx(track) {
        var m = track.style.transform.match(/translateX\(([^p]+)px\)/);
        return m ? parseFloat(m[1]) : 0;
    }

    function showCard(card, isActive) {
        var coll = card.querySelector('.fs-collapsed');
        var exp  = card.querySelector('.fs-expanded');
        if (isActive) {
            // Mostrar expandida con fade-in retardado
            coll.style.opacity        = '0';
            coll.style.pointerEvents  = 'none';
            exp.style.display         = 'flex';
            setTimeout(function() { exp.style.opacity = '1'; }, 120);
            exp.style.pointerEvents   = 'auto';
        } else {
            // Ocultar expandida instantáneamente
            coll.style.opacity        = '1';
            coll.style.pointerEvents  = '';
            exp.style.opacity         = '0';
            exp.style.pointerEvents   = 'none';
            // Quitar display tras fade (si hubiera)
            exp.style.display         = 'none';
        }
    }

    /* ── núcleo ─────────────────────────────── */
    function fsSetActive(idx) {
        active = ((idx % total) + total) % total;

        var cards = document.querySelectorAll('.fs-card');
        var track = document.getElementById('fs-track');

        // 1. Actualizar clases y visibilidad de contenido
        cards.forEach(function(card, i) {
            var isActive = (i === active);
            card.classList.toggle('fs-active', isActive);
            showCard(card, isActive);
        });

        // 2. Seguir la posición real del centro de la card activa con rAF loop
        cancelAnimationFrame(rafId);
        track.style.transition = 'none';
        var start = null;

        function loop(ts) {
            if (!start) start = ts;
            var activeCard = cards[active];
            var rect       = activeCard.getBoundingClientRect();
            var diff       = window.innerWidth / 2 - (rect.left + rect.width / 2);

            if (Math.abs(diff) > 0.3) {
                track.style.transform = 'translateX(' + (getTx(track) + diff) + 'px)';
            }
            if (ts - start < ANIM_MS) {
                rafId = requestAnimationFrame(loop);
            }
        }
        rafId = requestAnimationFrame(loop);

        // 3. Dots
        document.querySelectorAll('.fs-dot').forEach(function(dot, i) {
            dot.className = i === active
                ? 'fs-dot rounded-full bg-brand-yellow w-6 h-1.5 transition-all duration-500'
                : 'fs-dot rounded-full bg-white/25 w-1.5 h-1.5 hover:bg-white/50 transition-all duration-500';
        });
    }

    function fsPrev() { resetTimer(); fsSetActive(active - 1); }
    function fsNext() { resetTimer(); fsSetActive(active + 1); }

    function startTimer() {
        timer = setInterval(function() { fsSetActive(active + 1); }, 4000);
    }
    function resetTimer() {
        clearInterval(timer);
        startTimer();
    }

    // Pausar en hover
    var section = document.querySelector('[aria-label="Hoteles destacados"]');
    if (section) {
        section.addEventListener('mouseenter', function() { clearInterval(timer); });
        section.addEventListener('mouseleave', function() { startTimer(); });
    }

    window.fsSetActive = fsSetActive;
    window.fsPrev = fsPrev;
    window.fsNext = fsNext;

    function init() {
        // Inicializar todas como inactivas
        document.querySelectorAll('.fs-card').forEach(function(c) {
            c.classList.add('fs-inactive');
        });
        fsSetActive(0);
        startTimer();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

    window.addEventListener('resize', function() { fsSetActive(active); });
})();
</script>
@endif
