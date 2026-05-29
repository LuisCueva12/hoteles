@props(['movilidad'])

<div class="w-full">
    <nav class="mb-8 text-[11px] font-bold uppercase tracking-widest text-slate-400 flex items-center gap-2">
        <a href="{{ route('inicio') }}" class="hover:text-brand-yellow transition-colors">Volver al Catálogo</a>
        <span>/</span>
        <span class="text-brand-blue">{{ $movilidad->nombre }}</span>
    </nav>

    <div class="flex flex-col lg:flex-row gap-10 lg:gap-14 items-start">
        <div class="w-full lg:w-[45%] flex flex-col gap-6">
            <div class="relative w-full rounded overflow-hidden bg-slate-50 border border-slate-100 shadow-sm aspect-4/3">
                @if($movilidad->tiene_imagen)
                    <img src="{{ $movilidad->imagen_url }}"
                         alt="{{ $movilidad->nombre }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center">
                        <svg class="w-24 h-24 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                @endif
                
                <div class="absolute top-4 left-4 bg-white/90 text-brand-blue text-[10px] font-extrabold px-3 py-1.5 rounded-full uppercase tracking-widest shadow-sm">
                    {{ $movilidad->capital_categoria }}
                </div>
                @if($movilidad->marca && $movilidad->marca->tiene_logo)
                    <div class="absolute right-3 bottom-3 flex items-center justify-center rounded-lg bg-white/95 px-2 py-1.5 shadow-md ring-1 ring-brand-blue/10 backdrop-blur-sm sm:right-4 sm:bottom-4 sm:px-2.5 sm:py-2">
                        <img
                            src="{{ $movilidad->marca->logo_url }}"
                            alt="{{ $movilidad->marca->nombre }}"
                            class="h-8 w-auto max-w-[6.5rem] object-contain object-center sm:h-9 sm:max-w-[7.5rem] md:h-10 md:max-w-[8.5rem]"
                            width="136"
                            height="40"
                            loading="lazy"
                            decoding="async"
                        >
                    </div>
                @endif
            </div>

            <div class="pb-6 border-b border-slate-100">
                <h1 id="movilidad-nombre" class="text-3xl md:text-4xl font-extrabold text-brand-blue leading-tight mb-2">{{ $movilidad->nombre }}</h1>
                <p id="movilidad-meta" class="text-sm font-bold text-slate-400 tracking-wide uppercase">{{ $movilidad->marca?->nombre ?? 'Sin marca' }} <span class="mx-2 text-slate-200">|</span> {{ $movilidad->capital_categoria }}</p>
                <div class="mt-6 flex flex-wrap items-end gap-3">
                    <span class="text-sm font-bold text-slate-500 uppercase tracking-widest mb-1">Precio x Día:</span>
                    <div id="movilidad-precio" class="text-4xl font-black text-brand-blue tabular-nums" data-precio="S/.{{ number_format($movilidad->precio_base, 0) }}">S/.{{ number_format($movilidad->precio_base, 0) }}</div>
                </div>
                <div class="mt-6 flex flex-wrap gap-3">
                    <div class="flex items-center gap-2 bg-slate-50 border border-slate-100 px-4 py-2.5 rounded text-xs font-bold text-slate-600">
                        <svg class="w-4 h-4 text-brand-blue shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span id="max-pasajeros">{{ $movilidad->capacidad_pasajeros }}</span> Pasajeros Max
                    </div>
                    <div class="flex items-center gap-2 bg-slate-50 border border-slate-100 px-4 py-2.5 rounded text-xs font-bold text-slate-600 min-w-0">
                        <svg class="w-4 h-4 text-brand-blue shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span class="min-w-0">{{ $movilidad->ubicaciones->pluck('nombre')->join(', ') ?: 'Sin ubicación' }}</span>
                    </div>
                </div>
            </div>

            @if($movilidad->caracteristicas->count() > 0)
            <div class="bg-slate-50 rounded p-6 border border-slate-100">
                <h3 class="text-sm font-extrabold text-brand-blue mb-4 uppercase tracking-wider">Características Incluidas</h3>
                <ul class="grid grid-cols-1 sm:grid-cols-2 gap-y-3 gap-x-4">
                    @foreach($movilidad->caracteristicas as $caracteristica)
                        <li class="flex items-start gap-2.5 text-xs font-semibold text-slate-600">
                            <svg class="w-4 h-4 text-brand-blue shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                            </svg>
                            {{ $caracteristica->nombre }}
                        </li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <div class="w-full lg:w-[55%] flex flex-col lg:sticky lg:top-24">
            <div class="bg-white rounded shadow-[0_10px_40px_rgba(0,31,63,0.08)] border border-slate-100 p-6 md:p-8">
                <h3 class="text-sm font-extrabold text-brand-blue mb-5 uppercase tracking-wider flex items-center gap-2">
                    <svg class="w-5 h-5 text-brand-blue" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    Planifica tu Viaje
                </h3>

                @if(!$movilidad->estaDisponible())
                    <div class="bg-red-50 border border-red-100 text-red-700 rounded-xl p-4 text-sm font-bold mb-4">
                        Este vehículo no está disponible por el momento.
                    </div>
                @else
                @php
                    $slugsModalidades = $movilidad->modalidades->pluck('slug');
                    $modalidadPuedeCon = $slugsModalidades->contains('con_conductor');
                    $modalidadPuedeSin = $slugsModalidades->contains('sin_conductor');
                    $modalidadUnaSolaOpcion = $movilidad->modalidades->count() === 1;
                    $modalidadValorUnica = $movilidad->modalidades->first()?->slug ?? '';
                @endphp

                <form id="reserva-ws-form" method="POST" action="{{ route('reservar') }}" target="_blank" class="space-y-4">
                    @csrf
                    <input type="hidden" name="movilidad_id" value="{{ $movilidad->id }}">
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">
                                Nombre y Apellido <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="ws_nombre" name="cliente_nombre" required placeholder="Ingresa tu nombre" class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-semibold transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">
                                Documento (DNI/Pasaporte) <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="ws_documento" name="cliente_documento" required placeholder="Número de documento" class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-semibold transition-all">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">
                                WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="ws_whatsapp" name="cliente_whatsapp" required placeholder="Ej: 987654321" class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-semibold transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">
                                Ruta del Viaje <span class="text-red-500">*</span>
                            </label>
                            @php
                                $rutasVehiculo = $movilidad->rutas->where('activo', true)->values();
                            @endphp
                            @if($rutasVehiculo->isNotEmpty())
                                <select id="ws_ruta" name="ruta_viaje" required class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-semibold text-brand-blue transition-all">
                                    <option value="" disabled selected>Elegir ruta…</option>
                                    @foreach($rutasVehiculo as $ruta)
                                        <option value="{{ $ruta->nombre }}">{{ $ruta->nombre }}</option>
                                    @endforeach
                                </select>
                            @else
                                <input type="text" id="ws_ruta" name="ruta_viaje" required placeholder="Ej: Lima - Paracas" class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-semibold transition-all">
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="relative passenger-selector-container" data-max="{{ $movilidad->capacidad_pasajeros }}">
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">
                                Pasajeros <span class="text-red-500">*</span>
                            </label>
                            
                            <div class="btn-passenger-trigger w-full border border-slate-200 bg-white rounded px-4 py-3 text-sm cursor-pointer flex justify-between items-center transition-all hover:bg-slate-50">
                                <div class="flex items-center gap-2 font-semibold text-brand-blue">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    <span class="passenger-summary-text">1 pasajero</span>
                                </div>
                                <svg class="passenger-icon w-4 h-4 text-slate-400 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>

                            <div class="dropdown-passenger absolute z-50 w-full md:w-72 right-0 mt-2 bg-white rounded shadow-xl border border-slate-100 p-4 hidden">
                                <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <div class="text-sm font-bold text-brand-blue">Adultos</div>
                                            <div class="text-xs text-slate-400">18 o más años</div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-pax-minus w-7 h-7 rounded-sm border border-slate-200 flex items-center justify-center text-slate-500 disabled:opacity-30" data-type="adultos" disabled>-</button>
                                            <span class="w-5 text-center font-bold text-brand-blue pax-count-adultos">1</span>
                                            <button type="button" class="btn-pax-plus w-7 h-7 rounded-sm border border-brand-blue flex items-center justify-center text-brand-blue disabled:opacity-30" data-type="adultos">+</button>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                        <div>
                                            <div class="text-sm font-bold text-brand-blue">Adolescentes</div>
                                            <div class="text-xs text-slate-400">13-17 años</div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-pax-minus w-7 h-7 rounded-sm border border-slate-200 flex items-center justify-center text-slate-500 disabled:opacity-30" data-type="adolescentes" disabled>-</button>
                                            <span class="w-5 text-center font-bold text-brand-blue pax-count-adolescentes">0</span>
                                            <button type="button" class="btn-pax-plus w-7 h-7 rounded-sm border border-brand-blue flex items-center justify-center text-brand-blue disabled:opacity-30" data-type="adolescentes">+</button>
                                        </div>
                                    </div>
                                    
                                    <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                        <div>
                                            <div class="text-sm font-bold text-brand-blue">Niños</div>
                                            <div class="text-xs text-slate-400">2-12 años</div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-pax-minus w-7 h-7 rounded-sm border border-slate-200 flex items-center justify-center text-slate-500 disabled:opacity-30" data-type="ninos" disabled>-</button>
                                            <span class="w-5 text-center font-bold text-brand-blue pax-count-ninos">0</span>
                                            <button type="button" class="btn-pax-plus w-7 h-7 rounded-sm border border-brand-blue flex items-center justify-center text-brand-blue disabled:opacity-30" data-type="ninos">+</button>
                                        </div>
                                    </div>

                                    <div class="flex items-center justify-between border-t border-slate-100 pt-4">
                                        <div>
                                            <div class="text-sm font-bold text-brand-blue">Infantes</div>
                                            <div class="text-xs text-slate-400">0-23 meses</div>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <button type="button" class="btn-pax-minus w-7 h-7 rounded-sm border border-slate-200 flex items-center justify-center text-slate-500 disabled:opacity-30" data-type="infantes" disabled>-</button>
                                            <span class="w-5 text-center font-bold text-brand-blue pax-count-infantes">0</span>
                                            <button type="button" class="btn-pax-plus w-7 h-7 rounded-sm border border-brand-blue flex items-center justify-center text-brand-blue disabled:opacity-30" data-type="infantes">+</button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-5">
                                    <button type="button" class="btn-passenger-confirm w-full bg-brand-blue text-white font-bold py-2.5 rounded text-sm hover:bg-blue-900 transition-colors">
                                        Confirmar <span class="pax-warning text-xs font-normal text-yellow-300 hidden">(Máximo Permitido)</span>
                                    </button>
                                </div>
                            </div>
                            <input type="hidden" name="pasajeros_resumen" class="ws_pasajeros_resumen" value="1 Adulto(s), 0 Adolescente(s), 0 Niño(s), 0 Infante(s)">
                            <input type="hidden" name="adultos" class="ws_adultos" value="1">
                            <input type="hidden" name="ninos" class="ws_ninos" value="0">
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">
                                Modalidad <span class="text-red-500">*</span>
                            </label>
                            @if($modalidadUnaSolaOpcion)
                                <input type="hidden" name="modalidad" value="{{ old('modalidad', $modalidadValorUnica) }}">
                                <p class="rounded border border-slate-200 bg-slate-50 px-4 py-3 text-sm font-semibold text-brand-blue" id="ws_modalidad_leyenda">
                                    {{ $movilidad->modalidades->first()?->nombre }}
                                </p>
                            @else
                                <select id="ws_modalidad" name="modalidad" required class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-semibold transition-all">
                                    <option value="" @selected(! old('modalidad'))>Seleccionar</option>
                                    @foreach($movilidad->modalidades as $modalidad)
                                        <option value="{{ $modalidad->slug }}" @selected(old('modalidad') === $modalidad->slug)>{{ $modalidad->nombre }}</option>
                                    @endforeach
                                </select>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">Fecha de Recojo</label>
                            <input type="date" id="ws_fecha_inicio" name="fecha_inicio" required min="{{ date('Y-m-d') }}" class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-bold text-brand-blue transition-all">
                        </div>
                        <div>
                            <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">Fecha de Devolución</label>
                            <input type="date" id="ws_fecha_fin" name="fecha_fin" required min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-bold text-brand-blue transition-all">
                        </div>
                    </div>
                    
                    <div class="pt-2">
                        <label class="block text-[10px] font-extrabold text-slate-500 uppercase tracking-widest mb-1.5 ml-1">
                            Detalles / Requerimientos (Opcional)
                        </label>
                        <textarea id="ws_detalles" name="detalles" rows="2" placeholder="Equipaje extra, silla de bebé, etc." class="w-full border border-slate-200 bg-slate-50 rounded px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-brand-blue focus:bg-white font-semibold transition-all resize-none"></textarea>
                    </div>

                    <div class="pt-4 mt-2 border-t border-slate-100">
                        <button type="submit" class="w-full bg-brand-yellow text-brand-blue font-black uppercase tracking-widest py-4 rounded text-sm hover:-translate-y-1 hover:shadow-[0_8px_25px_rgba(255,214,0,0.5)] transition-all duration-300 flex items-center justify-center gap-2">
                            SOLICITAR RESERVA
                        </button>
                        <p class="text-center text-[10px] text-slate-400 mt-3 font-medium uppercase tracking-wider">Tu solicitud se enviará detallada para pronta confirmación</p>
                    </div>
                </form>

                @endif
            </div>
        </div>
    </div>
</div>


