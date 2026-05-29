@props(['hoteles'])

@php
    // We group/curate hotels in PHP first to attach travel style tags so JavaScript can filter them instantly.
    // 1. romantico: 5 Estrellas, Boutique, or sonesta/hilton
    // 2. familiar: 4 Estrellas, Sonesta, Todo Incluido, or capacity >= 3
    // 3. aventura: located in Cusco or Cajamarca
    // 4. negocios: located in Lima/Miraflores or has Gym/WiFi
@endphp

<section class="bg-gradient-to-b from-slate-50 to-white py-20 border-t border-slate-100 overflow-hidden" id="estilos-viaje-section">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        
        <div class="text-center mb-14">
            <span class="text-nav-meta text-brand-yellow font-bold mb-2 block">Experiencias a tu medida</span>
            <h2 class="section-title mb-3">
                <span class="text-brand-blue">Planifica según tu</span>
                <span class="text-brand-yellow"> Estilo de Viaje</span>
            </h2>
            <p class="text-slate-500 text-body-16 font-medium max-w-xl mx-auto">
                ¿Qué tipo de escape buscas? Selecciona tu estilo y descubre los alojamientos perfectos para tu próxima gran historia.
            </p>
        </div>

        <!-- Sleek Interactive Travel Style Tabs -->
        <div class="flex flex-wrap justify-center gap-3 md:gap-4 mb-12">
            <button type="button" data-style-trigger="romantico"
                class="active-style-tab flex items-center gap-2.5 px-6 py-3.5 rounded-2xl border text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-sm cursor-pointer focus:outline-none bg-brand-blue border-brand-blue text-white ring-2 ring-brand-blue/10">
                <x-dynamic-component :component="'lucide-heart'" class="w-4 h-4" stroke-width="2.5" />
                Romántico & Boutique
            </button>
            <button type="button" data-style-trigger="familiar"
                class="flex items-center gap-2.5 px-6 py-3.5 rounded-2xl border text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-sm cursor-pointer focus:outline-none bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300">
                <x-dynamic-component :component="'lucide-palmtree'" class="w-4 h-4" stroke-width="2.5" />
                Familiar & Relax
            </button>
            <button type="button" data-style-trigger="aventura"
                class="flex items-center gap-2.5 px-6 py-3.5 rounded-2xl border text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-sm cursor-pointer focus:outline-none bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300">
                <x-dynamic-component :component="'lucide-compass'" class="w-4 h-4" stroke-width="2.5" />
                Aventura & Cultura
            </button>
            <button type="button" data-style-trigger="negocios"
                class="flex items-center gap-2.5 px-6 py-3.5 rounded-2xl border text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-sm cursor-pointer focus:outline-none bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300">
                <x-dynamic-component :component="'lucide-briefcase'" class="w-4 h-4" stroke-width="2.5" />
                Negocios & Conectado
            </button>
        </div>

        <!-- Curated Hotel Grid with Dynamic Transitions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6" id="style-hotels-grid">
            @foreach($hoteles as $hotel)
                @php
                    $isRomantico = $hotel->categoria === '5 Estrellas' || str_contains(strtolower($hotel->nombre), 'premium') || str_contains(strtolower($hotel->nombre), 'garden');
                    $isFamiliar = $hotel->capacidad_personas >= 3 || str_contains(strtolower($hotel->nombre), 'posadas') || str_contains(strtolower($hotel->nombre), 'standard');
                    $isAventura = $hotel->destinos->contains(fn($d) => in_array($d->slug, ['cusco', 'cajamarca']));
                    $isNegocios = $hotel->destinos->contains(fn($d) => in_array($d->slug, ['lima', 'miraflores'])) || collect($hotel->caracteristicas)->pluck('nombre')->contains('WiFi Gratis');
                    
                    $styles = [];
                    if ($isRomantico) $styles[] = 'romantico';
                    if ($isFamiliar) $styles[] = 'familiar';
                    if ($isAventura) $styles[] = 'aventura';
                    if ($isNegocios) $styles[] = 'negocios';
                    
                    $stylesList = implode(' ', $styles);
                @endphp
                
                <div data-hotel-styles="{{ $stylesList }}" class="transition-all duration-500 transform scale-100 opacity-100 block">
                    <x-hoteles.tarjeta :hotel="$hotel" />
                </div>
            @endforeach
        </div>

        <div class="text-center mt-12">
            <p class="text-xs text-slate-400 font-semibold uppercase tracking-widest mb-4">¿Quieres ver más alternativas de hospedaje?</p>
            <a href="{{ route('hoteles.catalogo') }}" class="inline-flex items-center gap-2 bg-slate-100 text-brand-blue border border-slate-200 font-bold text-ui px-8 py-3.5 rounded-xl hover:bg-slate-200 transition-all shadow-sm">
                Explorar catálogo completo
                <x-dynamic-component :component="'lucide-arrow-right'" class="w-4 h-4" stroke-width="2.5" />
            </a>
        </div>

    </div>
</section>

<!-- Vanilla JS lightweight filter script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const triggers = document.querySelectorAll('[data-style-trigger]');
    const cards = document.querySelectorAll('#style-hotels-grid > div');

    const filterStyle = (selectedStyle) => {
        // 1. Update tab trigger button styles
        triggers.forEach(btn => {
            const btnStyle = btn.getAttribute('data-style-trigger');
            if (btnStyle === selectedStyle) {
                btn.className = "flex items-center gap-2.5 px-6 py-3.5 rounded-2xl border text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-sm cursor-pointer focus:outline-none bg-brand-blue border-brand-blue text-white ring-2 ring-brand-blue/10 scale-102";
            } else {
                btn.className = "flex items-center gap-2.5 px-6 py-3.5 rounded-2xl border text-sm font-bold uppercase tracking-wider transition-all duration-300 shadow-sm cursor-pointer focus:outline-none bg-white border-slate-200 text-slate-600 hover:bg-slate-50 hover:border-slate-300";
            }
        });

        // 2. Hide and show filtered hotel cards with smooth scaling transitions
        let visibleCount = 0;
        cards.forEach(card => {
            const styles = card.getAttribute('data-hotel-styles').split(' ');
            if (styles.includes(selectedStyle)) {
                card.style.display = 'block';
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'scale(1)';
                }, 50);
                visibleCount++;
            } else {
                card.style.opacity = '0';
                card.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    card.style.display = 'none';
                }, 300);
            }
        });
    };

    // Attach click events
    triggers.forEach(trigger => {
        trigger.addEventListener('click', () => {
            const selectedStyle = trigger.getAttribute('data-style-trigger');
            filterStyle(selectedStyle);
        });
    });

    // Initialize with first tab active
    filterStyle('romantico');
});
</script>
