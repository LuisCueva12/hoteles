@php
    $pasajerosFormId = $pasajerosFormId ?? 'form-hoteles-personas';
    $ordenActual = $orden ?? 'recientes';
    $opcionesOrden = [
        'recientes' => 'Más recientes',
        'precio_asc' => 'Precio: menor a mayor',
        'precio_desc' => 'Precio: mayor a menor',
        'capacidad_desc' => 'Mayor capacidad',
    ];
    $capFlotaSidebar = max(1, (int) ($filtros['capacidad_max_hoteles'] ?? 1));
    $sbPaxVal = 1;
    if (request()->filled('personas_min')) {
        $v = (int) request('personas_min');
        if ($v >= 2 && $v <= $capFlotaSidebar) {
            $sbPaxVal = $v;
        }
    }
@endphp

<div class="mb-5 max-lg:pt-5">
    <div class="hidden lg:flex lg:items-center lg:justify-between">
        <h2 class="text-base font-bold text-brand-blue">Filtros</h2>
        @if($filtrosSidebarActivos)
            <a href="{{ route('hoteles.catalogo') }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-sm font-semibold hover:bg-red-200 transition-colors">
                Limpiar
            </a>
        @endif
    </div>
    @if($filtrosSidebarActivos)
        <div class="flex justify-center lg:hidden">
            <a href="{{ route('hoteles.catalogo') }}" class="inline-flex items-center justify-center px-3 py-1.5 rounded-lg bg-red-100 text-red-700 text-sm font-semibold hover:bg-red-200 transition-colors">
                Limpiar
            </a>
        </div>
    @endif
</div>

<div class="mb-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Destino</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach($filtros['destinos'] as $destino)
            <a href="{{ route('hoteles.catalogo', array_merge(request()->except(['destino', 'page']), request('destino') == $destino->id ? [] : ['destino' => $destino->id])) }}"
               class="text-center px-3 py-2 text-sm font-medium rounded-lg border transition-all {{ request('destino') == $destino->id ? 'bg-brand-blue text-white border-brand-blue' : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-brand-blue hover:bg-slate-100' }}">
                {{ $destino->nombre }}
            </a>
        @endforeach
    </div>
</div>

<div class="border-t border-slate-200 pt-5 mb-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Cadena / Marca</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach($filtros['marcas'] as $marca)
            <a href="{{ route('hoteles.catalogo', array_merge(request()->except(['marca', 'page']), request('marca') == $marca->id ? [] : ['marca' => $marca->id])) }}"
               class="text-center px-3 py-2 text-sm font-medium rounded-lg border transition-all {{ request('marca') == $marca->id ? 'bg-brand-blue text-white border-brand-blue' : 'bg-slate-50 text-slate-700 border-slate-200 hover:border-brand-blue hover:bg-slate-100' }}">
                {{ $marca->nombre }}
            </a>
        @endforeach
    </div>
</div>

<div class="border-t border-slate-200 pt-5 mb-5">
    <label class="block text-sm font-semibold text-slate-700 mb-2.5">Estrellas</label>
    <div class="grid grid-cols-2 gap-2">
        @foreach($filtros['categorias'] as $cat)
            <a href="{{ route('hoteles.catalogo', array_merge(request()->except(['categoria', 'page']), request('categoria') === $cat ? [] : ['categoria' => $cat])) }}"
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
            <a href="{{ route('hoteles.catalogo', array_merge(request()->except(['modalidad', 'page']), request('modalidad') === $mod->slug ? [] : ['modalidad' => $mod->slug])) }}"
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
            <a href="{{ route('hoteles.catalogo', array_merge(request()->except(['orden', 'page']), $clave === 'recientes' ? [] : ['orden' => $clave])) }}"
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
        action="{{ route('hoteles.catalogo') }}"
        class="min-w-0 space-y-3"
        data-pax-min-counter
        data-pax-cap="{{ $capFlotaSidebar }}"
        data-pax-counter-auto-submit="1"
    >
        @foreach(request()->except(['personas_min', 'personas_max', 'page']) as $name => $value)
            @if(is_array($value))
                @foreach($value as $item)
                    <input type="hidden" name="{{ $name }}[]" value="{{ $item }}">
                @endforeach
            @elseif($value !== null && $value !== '')
                <input type="hidden" name="{{ $name }}" value="{{ $value }}">
            @endif
        @endforeach
        <input type="hidden" name="personas_min" class="hero-pax-hidden" value="{{ $sbPaxVal >= 2 ? $sbPaxVal : '' }}">
        <input type="hidden" name="personas_max" value="">
        
        <div class="flex flex-col select-none">
            <span class="text-sm font-semibold text-slate-700 mb-2.5 flex items-center gap-1">
                <x-dynamic-component :component="'lucide-users'" class="w-4 h-4 text-brand-blue" stroke-width="2" />
                Huéspedes
            </span>
            <div class="flex items-center justify-between bg-slate-50 border border-slate-200 rounded-lg p-2">
                <button type="button" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center font-bold text-ink cursor-pointer focus:outline-none" onclick="var el = this.nextElementSibling.querySelector('input'); var val = Math.max(1, parseInt(el.value) - 1); el.value = val; this.closest('form').querySelector('.hero-pax-hidden').value = val; this.nextElementSibling.querySelector('span').innerText = val + ' huéspedes'; this.closest('form').submit();">
                    -
                </button>
                <div class="text-center font-semibold text-ink-strong text-sm">
                    <input type="hidden" class="hero-pax-input" value="{{ $sbPaxVal }}">
                    <span>{{ $sbPaxVal }} huéspedes</span>
                </div>
                <button type="button" class="w-8 h-8 rounded-full bg-white border border-slate-200 flex items-center justify-center font-bold text-ink cursor-pointer focus:outline-none" onclick="var el = this.previousElementSibling.querySelector('input'); var val = Math.min({{ $capFlotaSidebar }}, parseInt(el.value) + 1); el.value = val; this.closest('form').querySelector('.hero-pax-hidden').value = val; this.previousElementSibling.querySelector('span').innerText = val + ' huéspedes'; this.closest('form').submit();">
                    +
                </button>
            </div>
        </div>
    </form>
</div>
