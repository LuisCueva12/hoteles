<x-layouts.web :title="'Nuestra Flota | '.config('app.name')" description="Explora nuestra amplia flota de vehículos disponibles para alquiler en todo el Perú. Encuentra el transporte ideal para tu próximo viaje.">

<div class="bg-brand-blue py-8">
    <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h1 class="text-3xl font-bold mb-2">
            <span class="text-white">Nuestra</span>
            <span class="text-brand-yellow"> Flota</span>
        </h1>
        <p class="text-slate-300 text-sm">{{ $movilidades->total() }} vehículos disponibles</p>
    </div>
</div>

@php
    $ordenVista = $orden ?? 'recientes';
    $capChip = max(1, (int) ($filtros['capacidad_max_flota'] ?? 1));
    $paxChipMin = request('pasajeros_min');
    $paxChipMax = request('pasajeros_max');
    $paxChipTieneMin = $paxChipMin !== null && $paxChipMin !== '' && ctype_digit((string) $paxChipMin) && (int) $paxChipMin >= 2;
    $paxChipTieneMax = $paxChipMax !== null && $paxChipMax !== '' && ctype_digit((string) $paxChipMax) && (int) $paxChipMax < $capChip;
    $filtrosSidebarActivos = request()->hasAny(['ubicacion', 'marca', 'categoria', 'modalidad'])
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
                <details id="flota-filtros-movil" class="group mb-6 rounded-xl border border-slate-200 bg-white shadow-sm lg:hidden">
                    <summary class="flex items-center justify-center gap-2 cursor-pointer list-none px-4 py-4 text-base font-bold text-brand-blue [&::-webkit-details-marker]:hidden">
                        <x-dynamic-component :component="'lucide-sliders-horizontal'" class="w-4 h-4 shrink-0" stroke-width="2" />
                        Filtros
                        <x-dynamic-component :component="'lucide-chevron-down'" class="w-4 h-4 shrink-0 transition-transform group-open:rotate-180" stroke-width="2" />
                    </summary>
                    <div class="border-t border-slate-200 px-5 pb-5 pt-0">
                        @include('pages.flota.partials.filtros-sidebar-inner', ['pasajerosFormId' => 'form-flota-pasajeros-movil'])
                    </div>
                </details>

                <div class="hidden lg:block">
                    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-5">
                        @include('pages.flota.partials.filtros-sidebar-inner', ['pasajerosFormId' => 'form-flota-pasajeros-escritorio'])
                    </div>
                </div>
            </aside>

            <div class="lg:col-span-9">
                @if($filtrosSidebarActivos)
                    <div class="mb-6 flex flex-wrap items-center gap-2">
                        <span class="text-sm font-medium text-slate-600">Filtros activos:</span>
                        @if(request('ubicacion'))
                            @php
                                $ubicacionActiva = $filtros['ubicaciones']->firstWhere('id', request('ubicacion'));
                            @endphp
                            @if($ubicacionActiva)
                                <a href="{{ route('flota', request()->except(['ubicacion', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                    {{ $ubicacionActiva->nombre }}
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
                                <a href="{{ route('flota', request()->except(['marca', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                    {{ $marcaActiva->nombre }}
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                </a>
                            @endif
                        @endif
                        @if(request('categoria'))
                            <a href="{{ route('flota', request()->except(['categoria', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
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
                            <a href="{{ route('flota', request()->except(['modalidad', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
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
                                    $etiquetaPaxChip = (int) $paxChipMin . '–' . (int) $paxChipMax . ' pasajeros';
                                } elseif ($paxChipTieneMin) {
                                    $etiquetaPaxChip = 'Desde ' . (int) $paxChipMin . ' pasajeros';
                                } else {
                                    $etiquetaPaxChip = 'Hasta ' . (int) $paxChipMax . ' pasajeros';
                                }
                            @endphp
                            <a href="{{ route('flota', request()->except(['pasajeros_min', 'pasajeros_max', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-blue text-white text-xs font-medium px-3 py-1.5 rounded-full hover:bg-blue-900 transition-colors">
                                {{ $etiquetaPaxChip }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                        @if($ordenVista !== 'recientes' && isset($etiquetasOrdenChip[$ordenVista]))
                            <a href="{{ route('flota', request()->except(['orden', 'page'])) }}" class="inline-flex items-center gap-1.5 bg-brand-yellow text-brand-blue text-xs font-semibold px-3 py-1.5 rounded-full hover:bg-yellow-400 transition-colors">
                                {{ $etiquetasOrdenChip[$ordenVista] }}
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </a>
                        @endif
                    </div>
                @endif

                @if($movilidades->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
                        @foreach($movilidades as $movilidad)
                            <x-movilidades.tarjeta-vertical :movilidad="$movilidad" />
                        @endforeach
                    </div>

                    @if($movilidades->hasPages())
                        <div class="mt-8">
                            {{ $movilidades->links() }}
                        </div>
                    @endif
                @else
                    <div class="bg-white rounded-xl border border-slate-200 text-center py-20 px-6">
                        <div class="text-slate-300 mb-4 flex justify-center">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-brand-blue mb-2">No hay resultados</h3>
                        <p class="text-slate-500 text-sm mb-6">No encontramos vehículos con los filtros seleccionados</p>
                        <a href="{{ route('flota') }}" class="inline-flex items-center gap-2 bg-brand-blue text-white font-bold text-sm px-6 py-3 rounded-lg hover:bg-blue-900 transition-colors">
                            Ver todos los vehículos
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

</x-layouts.web>
