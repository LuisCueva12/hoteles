@props(['destinos'])

<section class="bg-white py-14">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="section-title mb-2">
                <span class="text-brand-blue">Explora por</span>
                <span class="text-brand-yellow"> Destinos</span>
            </h2>
            <p class="text-ink text-body-16 font-medium max-w-xl mx-auto">Encuentra los mejores alojamientos disponibles por destino turístico</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
            @foreach($destinos as $destino)
                <a href="{{ route('hoteles.catalogo', ['destino' => $destino->id]) }}" class="group relative h-52 rounded-2xl overflow-hidden border border-brand-blue/15 shadow-sm hover:shadow-xl hover:border-brand-yellow/40 transition-all duration-300">
                    @if($destino->imagen_url)
                        <img src="{{ $destino->imagen_url }}" alt="{{ $destino->nombre }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-slate-100 text-brand-blue/35" aria-hidden="true">
                            <x-dynamic-component :component="'lucide-map-pinned'" class="w-14 h-14" stroke-width="1.5" />
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-linear-to-t from-brand-blue/85 via-brand-blue/30 to-transparent"></div>
                    <div class="absolute inset-x-0 bottom-0 p-5">
                        <p class="text-white text-xl font-extrabold tracking-wide">{{ $destino->nombre }}</p>
                        <p class="text-white text-body-16 font-semibold mt-1 drop-shadow-sm">Ver hoteles disponibles</p>
                    </div>
                </a>
            @endforeach
        </div>

        <div class="text-center mt-8">
            <a href="{{ route('hoteles.catalogo') }}" class="inline-flex items-center gap-2 bg-brand-blue text-white font-bold text-ui px-8 py-3 rounded-lg hover:bg-blue-900 transition-colors shadow-sm">
                Ver todos los destinos
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</section>
