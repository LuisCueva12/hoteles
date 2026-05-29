@props(['movilidad'])

<article class="bg-white rounded-xl shadow-[0_4px_15px_rgb(0,0,0,0.05)] border border-slate-100 flex flex-col md:flex-row overflow-hidden w-full">
    
    <div class="relative w-full md:w-5/12 lg:w-2/5 shrink-0">
        <button class="absolute top-3 left-3 z-10 w-8 h-8 bg-white rounded-full flex items-center justify-center shadow-md text-brand-yellow hover:text-brand-blue transition-colors">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/></svg>
        </button>

        <div class="absolute top-4 right-4 z-10 bg-white px-3 py-1 rounded-full shadow-sm">
            <span class="text-[11px] font-bold text-slate-700">Destacado</span>
        </div>

        @if($movilidad->tiene_imagen)
            <img src="{{ $movilidad->imagen_url }}" alt="{{ $movilidad->nombre }}" class="w-full h-56 md:h-full object-cover">
        @else
            <div class="w-full h-56 md:h-full bg-slate-100 flex items-center justify-center">
                <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
        @endif
    </div>

    <div class="p-6 md:p-8 flex flex-col justify-between w-full min-w-0">
        <div>
            <h3 class="text-xl md:text-2xl font-black text-brand-blue uppercase tracking-wide mb-1 truncate">
                {{ $movilidad->nombre }}
            </h3>
            
            <div class="flex items-center gap-1 mb-3" aria-hidden="true">
                @for($i = 0; $i < 4; $i++)
                    <svg class="w-4 h-4 text-brand-yellow" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
                <svg class="w-4 h-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
            </div>

            <div class="mb-5 flex items-baseline flex-wrap gap-2">
                <span class="text-xl font-bold text-brand-yellow">S/ {{ number_format($movilidad->precio_base, 2) }}</span>
                <span class="text-sm font-medium text-slate-800">| Por Día</span>
                <span class="text-xs text-slate-400">({{ $movilidad->ubicacion }})</span>
            </div>

            <div class="flex items-center gap-6 mb-7 text-slate-600">
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 stroke-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    <span class="text-[10px] mt-1 font-bold">{{ $movilidad->capacidad_pasajeros }} Pax</span>
                </div>
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 stroke-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span class="text-[10px] mt-1 font-bold">Eq.</span>
                </div>
                <div class="flex flex-col items-center">
                    <svg class="w-6 h-6 stroke-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <span class="text-[10px] mt-1 font-bold uppercase truncate max-w-[50px]" title="{{ $movilidad->modalidades->pluck('nombre')->join(', ') }}">{{ $movilidad->modalidades->first()?->nombre ?? '—' }}</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-center gap-3 w-full">
            <a href="{{ route('movilidad.detalle', $movilidad) }}" class="bg-brand-yellow hover:bg-yellow-400 text-brand-blue font-bold text-sm px-6 py-2.5 rounded shadow-sm transition-colors text-center uppercase w-full sm:w-auto">
                Ver Más
            </a>

            <div class="w-full sm:w-16">
                <input type="number" value="1" min="1" max="{{ $movilidad->capacidad_pasajeros }}" class="w-full text-center border border-slate-300 rounded py-2 text-sm font-semibold focus:outline-none focus:border-brand-blue">
            </div>

            <a href="{{ route('movilidad.detalle', $movilidad) }}" class="bg-brand-blue hover:bg-blue-900 text-white font-bold text-sm px-6 py-2.5 rounded shadow-sm transition-colors flex-1 w-full text-center truncate">
                Reservar
            </a>
        </div>
    </div>
</article>
