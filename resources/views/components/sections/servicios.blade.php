<section id="servicios" aria-labelledby="servicios-titulo" class="bg-slate-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <header class="text-center max-w-2xl mx-auto mb-14">
            <h2 id="servicios-titulo" class="section-title leading-tight tracking-tight mb-4">
                <span class="text-brand-blue">Servicios de movilidad</span>
                <span class="text-brand-yellow"> en Cajamarca y todo el Perú</span>
            </h2>
            <p class="text-ink text-body-16 font-medium">
                Traslados al aeropuerto, viajes interprovinciales, transporte corporativo y más. Misma exigencia de puntualidad y seguridad en destino o en ruta.
            </p>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @php
            $servicios = [
                [
                    'titulo'      => 'Traslado al aeropuerto',
                    'descripcion' => 'Llegamos a tiempo para llevarte o recogerte del Aeropuerto Jorge Chávez. Puntualidad garantizada las 24 horas.',
                    'etiquetas'   => ['Disponible 24/7', 'Lima → AEP'],
                    'icono'       => 'plane-takeoff',
                ],
                [
                    'titulo'      => 'Viajes interprovinciales',
                    'descripcion' => 'Viaja cómodo a cualquier provincia del Perú. Ica, Cusco, Arequipa, Trujillo y todos los destinos disponibles.',
                    'etiquetas'   => ['Todo el Perú', 'Con conductor'],
                    'icono'       => 'route',
                ],
                [
                    'titulo'      => 'Traslado corporativo',
                    'descripcion' => 'Soluciones de movilidad para empresas: ejecutivos, visitas de clientes y eventos. Con facturación electrónica.',
                    'etiquetas'   => ['Empresas', 'Factura'],
                    'icono'       => 'briefcase',
                ],
                [
                    'titulo'      => 'Eventos especiales',
                    'descripcion' => 'Bodas, quinceañeros, graduaciones, giras. Hacemos tu evento memorable con la mejor flota de vehículos.',
                    'etiquetas'   => ['Premium', 'A medida'],
                    'icono'       => 'ticket',
                ],
                [
                    'titulo'      => 'Transporte escolar',
                    'descripcion' => 'Paseos escolares y excursiones educativas con total seguridad. SOAT vigente y conductores con experiencia en grupos.',
                    'etiquetas'   => ['Seguro', 'SOAT incluido'],
                    'icono'       => 'users',
                ],
                [
                    'titulo'      => 'Conductores verificados y flota moderna',
                    'descripcion' => 'Conductores certificados con amplia experiencia y vehículos modernos en óptimo estado para viajes seguros y cómodos.',
                    'etiquetas'   => ['Verificados', 'Flota moderna'],
                    'icono'       => 'shield-check',
                ],
            ];
            @endphp

            @foreach($servicios as $servicio)
                <article class="group bg-white rounded-2xl border border-brand-blue/12 p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 hover:border-brand-yellow/45 transition-all duration-300">
                    <div class="w-12 h-12 rounded-xl bg-brand-yellow/25 text-brand-blue flex items-center justify-center mb-5 ring-1 ring-brand-blue/10 group-hover:scale-110 group-hover:bg-brand-yellow/35 transition-all duration-300" aria-hidden="true">
                        <x-dynamic-component :component="'lucide-'.$servicio['icono']" class="w-6 h-6" stroke-width="2" />
                    </div>
                    <h3 class="text-card-title text-ink-strong mb-2">{{ $servicio['titulo'] }}</h3>
                    <p class="text-ink text-body-16 font-medium mb-4">{{ $servicio['descripcion'] }}</p>
                    <div class="flex flex-wrap items-center gap-2">
                        @foreach($servicio['etiquetas'] as $etiqueta)
                            <span class="inline-block bg-brand-yellow/10 text-brand-blue text-chip px-3 py-1.5 rounded-full">
                                {{ $etiqueta }}
                            </span>
                        @endforeach
                    </div>
                </article>
            @endforeach

        </div>
    </div>
</section>
