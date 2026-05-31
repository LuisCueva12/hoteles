<x-layouts.web :title="'Nuestros Hoteles | '.config('app.name')" description="Explora nuestra amplia selección de hoteles y alojamientos verificados en el Perú. Encuentra tu estadía ideal al mejor precio.">

<section class="relative isolate w-full overflow-hidden bg-brand-blue -mt-[108px] md:-mt-[128px] min-h-[280px] md:min-h-[300px] flex items-end">
    <img
        src="{{ asset('img/hero-principal.webp') }}"
        alt="Catálogo de hoteles en el Perú — {{ config('app.name') }}"
        class="absolute inset-0 w-full h-full object-cover object-center"
        loading="eager"
        decoding="async"
    >
    <div class="absolute inset-0 bg-gradient-to-t from-brand-blue/90 via-brand-blue/55 to-brand-blue/30" aria-hidden="true"></div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8 text-center pb-10 pt-[140px] md:pt-[160px]">
        <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight tracking-tight mb-3">
            <span class="text-white">Nuestros</span>
            <span class="text-brand-yellow"> Hoteles</span>
        </h1>
        <p class="text-white/70 text-sm font-medium">{{ $hoteles->total() }} hoteles disponibles en todo el Perú</p>
    </div>
</section>

@php
    $ordenVista = $orden ?? 'recientes';
    $capChip = max(1, (int) ($filtros['capacidad_max_hoteles'] ?? 1));
    $paxChipMin = request('personas_min');
    $paxChipMax = request('personas_max');
    $paxChipTieneMin = $paxChipMin !== null && $paxChipMin !== '' && ctype_digit((string) $paxChipMin) && (int) $paxChipMin >= 2;
    $paxChipTieneMax = $paxChipMax !== null && $paxChipMax !== '' && ctype_digit((string) $paxChipMax) && (int) $paxChipMax < $capChip;
    $filtrosSidebarActivos = request()->hasAny(['destino', 'marca', 'categoria', 'modalidad'])
        || $paxChipTieneMin
        || $paxChipTieneMax
        || $ordenVista !== 'recientes';
    $etiquetasOrdenChip = [
        'precio_asc' => 'Precio ↑',
        'precio_desc' => 'Precio ↓',
        'capacidad_desc' => 'Mayor capacidad',
    ];
@endphp

<div class="bg-slate-50 min-h-screen py-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <aside class="lg:col-span-3">
                <details id="hotel-filtros-movil" class="group mb-6 rounded-xl border border-slate-200 bg-white shadow-sm lg:hidden">
                    <summary class="flex items-center justify-center gap-2 cursor-pointer list-none px-4 py-4 text-base font-bold text-brand-blue [&::-webkit-details-marker]:hidden">
                        <x-dynamic-component :component="'lucide-sliders-horizontal'" class="w-4 h-4 shrink-0" stroke-width="2" />
                        Filtros
                        <x-dynamic-component :component="'lucide-chevron-down'" class="w-4 h-4 shrink-0 transition-transform group-open:rotate-180" stroke-width="2" />
                    </summary>
                    <div class="border-t border-slate-200 px-5 pb-5 pt-0">
                        @include('pages.hoteles-catalogo.partials.filtros-sidebar-inner', ['pasajerosFormId' => 'form-hotel-huespedes-movil'])
                    </div>
                </details>

                <div class="hidden lg:block">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                        @include('pages.hoteles-catalogo.partials.filtros-sidebar-inner', ['pasajerosFormId' => 'form-hotel-huespedes-escritorio'])
                    </div>
                </div>
            </aside>

            <div class="lg:col-span-9">
                @if($filtrosSidebarActivos)
                    <div class="mb-6 flex flex-wrap items-center gap-2">
                        <span class="text-sm font-medium text-slate-600">Filtros activos:</span>
                        @if(request('destino'))
                            @php
                                $destinoActivo = $filtros['destinos']->firstWhere('id', request('destino'));
                            @endphp
                            @if($destinoActivo)
                                <a href="{{ route('hoteles.catalogo', request()->except(['destino', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                    {{ $destinoActivo->nombre }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif
                        @endif
                        @if(request('marca'))
                            @php
                                $marcaActiva = $filtros['marcas']->firstWhere('id', request('marca'));
                            @endphp
                            @if($marcaActiva)
                                <a href="{{ route('hoteles.catalogo', request()->except(['marca', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                    {{ $marcaActiva->nombre }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif
                        @endif
                        @if(request('categoria'))
                            <a href="{{ route('hoteles.catalogo', request()->except(['categoria', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                {{ request('categoria') }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                        @if(request('modalidad'))
                            @php
                                $modalidadActiva = $filtros['modalidades']->firstWhere('slug', request('modalidad'));
                            @endphp
                            @if($modalidadActiva)
                            <a href="{{ route('hoteles.catalogo', request()->except(['modalidad', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                {{ $modalidadActiva->nombre }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                            @endif
                        @endif
                        @if($paxChipTieneMin || $paxChipTieneMax)
                            @php
                                if ($paxChipTieneMin && $paxChipTieneMax) {
                                    $etiquetaPaxChip = (int) $paxChipMin . '–' . (int) $paxChipMax . ' huéspedes';
                                } elseif ($paxChipTieneMin) {
                                    $etiquetaPaxChip = 'Desde ' . (int) $paxChipMin . ' huéspedes';
                                } else {
                                    $etiquetaPaxChip = 'Hasta ' . (int) $paxChipMax . ' huéspedes';
                                }
                            @endphp
                            <a href="{{ route('hoteles.catalogo', request()->except(['personas_min', 'personas_max', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                {{ $etiquetaPaxChip }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                        @if($ordenVista !== 'recientes' && isset($etiquetasOrdenChip[$ordenVista]))
                            <a href="{{ route('hoteles.catalogo', request()->except(['orden', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-yellow text-brand-blue text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-yellow-400 transition-colors">
                                {{ $etiquetasOrdenChip[$ordenVista] }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif

                @if($hoteles->count() > 0)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 px-6 sm:px-10 py-6">
                        @foreach($hoteles as $hotel)
                            <x-hoteles.tarjeta-lista :hotel="$hotel" />
                        @endforeach
                    </div>

                    @if($hoteles->hasPages())
                        <div class="mt-8">
                            {{ $hoteles->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-white rounded-xl border border-slate-200 text-center py-20 px-6">
                        <div class="text-slate-300 mb-4 flex justify-center">
                            <x-dynamic-component :component="'lucide-hotel'" class="w-16 h-16" stroke-width="1.5" />
                        </div>
                        <h3 class="text-xl font-bold text-brand-blue mb-2">No hay resultados</h3>
                        <p class="text-slate-500 text-sm mb-6">No encontramos hoteles con los filtros seleccionados</p>
                        <a href="{{ route('hoteles.catalogo') }}" class="inline-flex items-center gap-2 bg-brand-blue text-white font-bold text-sm px-6 py-3 rounded-lg hover:bg-blue-900 transition-colors">
                            Ver todos los hoteles
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

</x-layouts.web>
