<section id="nosotros" aria-labelledby="nosotros-titulo" class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

            <div>
                <h2 id="nosotros-titulo" class="section-title text-left leading-tight tracking-tight mb-5">
                    <span class="text-brand-blue">Hospédate con confort</span>
                    <span class="text-brand-yellow"> y la atención que mereces</span>
                </h2>
                <p class="text-ink text-body-16 font-medium mb-8">
                    En Cajamarca y en todo el Perú ofrecemos los mejores hoteles verificados, con la misma calidad que esperas de una plataforma nacional: alojamiento cómodo, precios transparentes y atención personalizada para cada estadía.
                </p>

                @php
                $ventajas = [
                    [
                        'texto' => 'Hoteles verificados con habitaciones cómodas y atención de primera',
                        'icono' => 'shield-check',
                    ],
                    [
                        'texto' => 'Amplia variedad: 3, 4 y 5 estrellas, boutique y resorts en todo el Perú',
                        'icono' => 'building-2',
                    ],
                    [
                        'texto' => 'Reserva fácil y rápida, disponible las 24 horas por WhatsApp',
                        'icono' => 'clock',
                    ],
                ];
                @endphp

                <ul class="space-y-4 mb-10">
                    @foreach($ventajas as $ventaja)
                        <li class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-xl bg-brand-yellow/25 text-brand-blue ring-1 ring-brand-blue/10 flex items-center justify-center shrink-0 mt-0.5" aria-hidden="true">
                                <x-dynamic-component :component="'lucide-'.$ventaja['icono']" class="w-5 h-5" stroke-width="2" />
                            </div>
                            <p class="text-ink text-body-16 font-semibold pt-1">{{ $ventaja['texto'] }}</p>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="relative">
                <div class="relative min-h-[460px] overflow-hidden rounded-3xl shadow-2xl">
                    <img
                        src="{{ asset('img/viaje-seguro.webp') }}"
                        alt="Hotel con vistas privilegiadas en el Perú: alojamiento cómodo y verificado para tu estadía con {{ config('app.name') }}." title="Hotel con vistas privilegiadas en el Perú: alojamiento cómodo y verificado para tu estadía con {{ config('app.name') }}."
                        width="1280"
                        height="720"
                        class="absolute inset-0 h-full w-full object-cover object-center"
                        loading="lazy"
                        decoding="async"
                    >
                    <div class="absolute inset-0 bg-gradient-to-br from-brand-blue/10 via-transparent to-brand-blue/55" aria-hidden="true"></div>



                </div>

                <div class="absolute -bottom-4 -right-4 w-24 h-24 rounded-2xl bg-brand-yellow/20 border border-brand-yellow/30 -z-10" aria-hidden="true"></div>
                <div class="absolute -top-4 -left-4 w-16 h-16 rounded-xl bg-brand-blue/10 border border-brand-blue/20 -z-10" aria-hidden="true"></div>
            </div>

        </div>
    </div>
</section>
