<section id="servicios" aria-labelledby="servicios-titulo" class="bg-slate-50 py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <header class="text-center max-w-2xl mx-auto mb-14">
            <h2 id="servicios-titulo" class="section-title leading-tight tracking-tight mb-4">
                <span class="text-brand-blue">Servicios de alojamiento</span>
                <span class="text-brand-yellow"> en Cajamarca y todo el Perú</span>
            </h2>
            <p class="text-ink text-body-16 font-medium">
                Reservas de hotel, paquetes corporativos, estadías familiares y más. La misma calidad y atención personalizada en cada destino del Perú.
            </p>
        </header>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            @php
            $servicios = [
                [
                    'titulo'      => 'Reservas de hotel',
                    'descripcion' => 'Encuentra y reserva tu alojamiento ideal en segundos. Habitaciones verificadas con disponibilidad en tiempo real.',
                    'etiquetas'   => ['Confirmación inmediata', 'Mejor precio'],
                    'icono'       => 'bed-double',
                ],
                [
                    'titulo'      => 'Hospedaje corporativo',
                    'descripcion' => 'Alojamiento para ejecutivos, equipos y visitas empresariales. Facturación electrónica y tarifas preferenciales.',
                    'etiquetas'   => ['Empresas', 'Factura'],
                    'icono'       => 'briefcase',
                ],
                [
                    'titulo'      => 'Paquetes familiares',
                    'descripcion' => 'Habitaciones amplias y ambientes pensados para disfrutar en familia. Opciones con desayuno incluido y amenidades.',
                    'etiquetas'   => ['Familias', 'Todo incluido'],
                    'icono'       => 'users',
                ],
                [
                    'titulo'      => 'Eventos y grupos',
                    'descripcion' => 'Coordinamos alojamiento para bodas, graduaciones, giras y encuentros. Bloques de habitaciones con tarifas especiales.',
                    'etiquetas'   => ['Premium', 'A medida'],
                    'icono'       => 'ticket',
                ],
                [
                    'titulo'      => 'Hoteles de lujo',
                    'descripcion' => 'Experiencias premium en los mejores resorts y hoteles boutique del Perú. Spa, restaurante gourmet y vistas privilegiadas.',
                    'etiquetas'   => ['5 Estrellas', 'Boutique'],
                    'icono'       => 'star',
                ],
                [
                    'titulo'      => 'Hoteles verificados',
                    'descripcion' => 'Cada hotel es revisado y validado antes de ofrecerlo. Habitaciones cómodas, ubicaciones convenientes y atención directa.',
                    'etiquetas'   => ['Verificados', 'Garantizados'],
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
