@php
    $pasajerosFormId = $pasajerosFormId ?? 'form-flota-pasajeros';
    $ordenActual = $orden ?? 'recientes';
    $opcionesOrden = [
        'recientes' => 'Más recientes',
        'precio_asc' => 'Precio: menor a mayor',
        'precio_desc' => 'Precio: mayor a menor',
        'capacidad_desc' => 'Mayor capacidad',
    ];
    $capFlotaSidebar = max(1, (int) ($filtros['capacidad_max_flota'] ?? 1));
    $sbPaxVal = 1;
    if (request()->filled('pasajeros_min')) {
        $v = (int) request('pasajeros_min');
        if ($v >= 2 && $v <= $capFlotaSidebar) {
            $sbPaxVal = $v;
        }
    }
@endphp

<div class="mb-5 max-lg:pt-5">
    <div class="hidden lg:flex lg:items-center lg:justify-between">
        <h2 class="text-base font-bold text-brand-blue">Filtros</h2>
        @if($filtrosSidebarActivos)
            <a href="{{ route('flota') }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-sm font-semibold hover:bg-red-200 transition-colors">
                Limpiar
            </a>
        @endif
    </div>
    @if($filtrosSidebarActivos)
        <div class="flex justify-center lg:hidden">
            <a href="{{ route('flota') }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-sm font-semibold hover:bg-red-200 transition-colors">
                Limpiar
            </a>
        </div>
    @endif
</div>

<div class="mb-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Destino</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach($filtros['ubicaciones'] as $ubicacion)
            <a href="{{ route('flota', array_merge(request()->except(['ubicacion', 'page']), request('ubicacion') == $ubicacion->id ? [] : ['ubicacion' => $ubicacion->id])) }}"
               class="text-center px-3 py-2 text-sm font-medium rounded-lg border transition-all {{ request('ubicacion') == $ubicacion->id ? 'bg-brand-blue text-white border-brand-blue' : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-brand-blue hover:bg-slate-100' }}">
                {{ $ubicacion->nombre }}
            </a>
        @endforeach
    </div>
</div>

<div class="border-t border-slate-200 pt-5 mb-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Marca</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach($filtros['marcas'] as $marca)
            <a href="{{ route('flota', array_merge(request()->except(['marca', 'page']), request('marca') == $marca->id ? [] : ['marca' => $marca->id])) }}"
               class="text-center px-3 py-2 text-sm font-medium rounded-lg border transition-all {{ request('marca') == $marca->id ? 'bg-brand-blue text-white border-brand-blue' : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-brand-blue hover:bg-slate-100' }}">
                {{ $marca->nombre }}
            </a>
        @endforeach
    </div>
</div>

<div class="border-t border-slate-200 pt-5 mb-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Categoría</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach($filtros['categorias'] as $cat)
            <a href="{{ route('flota', array_merge(request()->except(['categoria', 'page']), request('categoria') === $cat ? [] : ['categoria' => $cat])) }}"
               class="text-center px-3 py-2 text-sm font-medium rounded-lg border transition-all {{ request('categoria') === $cat ? 'bg-brand-blue text-white border-brand-blue' : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-brand-blue hover:bg-slate-100' }}">
                {{ $cat }}
            </a>
        @endforeach
    </div>
</div>

<div class="border-t border-slate-200 pt-5 mb-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Modalidad</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach($filtros['modalidades'] as $mod)
            <a href="{{ route('flota', array_merge(request()->except(['modalidad', 'page']), request('modalidad') === $mod->slug ? [] : ['modalidad' => $mod->slug])) }}"
               class="text-center px-3 py-2 text-sm font-medium rounded-lg border transition-all {{ request('modalidad') === $mod->slug ? 'bg-brand-blue text-white border-brand-blue' : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-brand-blue hover:bg-slate-100' }}">
                {{ $mod->nombre }}
            </a>
        @endforeach
    </div>
</div>

<div class="border-t border-slate-200 pt-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Ordenar</label>
    <div class="flex flex-col gap-2">
        @foreach($opcionesOrden as $clave => $etiqueta)
            @php
                $activoOrden = $ordenActual === $clave;
            @endphp
            <a href="{{ route('flota', array_merge(request()->except(['orden', 'page']), $clave === 'recientes' ? [] : ['orden' => $clave])) }}"
               class="w-full text-center px-3 py-2.5 text-sm font-medium rounded-lg border transition-all {{ $activoOrden ? 'bg-brand-yellow/25 text-brand-blue border-brand-yellow shadow-sm' : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-brand-blue hover:bg-slate-100' }}">
                {{ $etiqueta }}
            </a>
        @endforeach
    </div>
</div>

<div class="border-t border-slate-200 pt-5 mt-5 min-w-0 overflow-x-clip">
    <form
        id="{{ $pasajerosFormId }}"
        method="get"
        action="{{ route('flota') }}"
        class="min-w-0 space-y-3"
        data-pax-min-counter
        data-pax-cap="{{ $capFlotaSidebar }}"
        data-pax-counter-auto-submit="1"
    >
        @foreach(request()->except(['pasajeros_min', 'pasajeros_max', 'page']) as $name => $value)
            @if(is_array($value))
                @foreach($value as $item)
                    <input type="hidden" name="{{ $name }}[]" value="{{ $item }}">
                @endforeach
            @elseif($value !== null && $value !== '')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endif
        @endforeach
        <input type="hidden" name="pasajeros_min" class="hero-pax-hidden" value="{{ $sbPaxVal >= 2 ? $sbPaxVal : '' }}">
        <input type="hidden" name="pasajeros_max" value="">
        <x-movilidades.pasajeros-contador-campo :cap-max="$capFlotaSidebar" :count="$sbPaxVal" />
    </form>
</div>
