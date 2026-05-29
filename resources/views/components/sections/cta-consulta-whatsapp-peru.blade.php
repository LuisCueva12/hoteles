<section class="bg-white py-16" aria-labelledby="cta-consulta-titulo">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="flex min-h-[19rem] flex-col overflow-hidden rounded-3xl shadow-[0_20px_50px_rgba(0,31,63,0.12)] ring-1 ring-black/5 lg:min-h-[20rem] lg:flex-row lg:items-stretch">
            <div class="flex w-full flex-col justify-center gap-5 bg-brand-blue px-8 py-10 text-left text-white lg:w-[42%] lg:shrink-0 lg:basis-[42%] lg:px-10 xl:px-12 xl:py-14">
                <h2 id="cta-consulta-titulo" class="text-xl font-extrabold leading-snug tracking-tight text-white md:text-2xl">
                    ¿No encuentras el vehículo que necesitas?
                </h2>
                <p class="text-[0.9375rem] font-medium leading-relaxed text-white/90 md:text-base">
                    Tenemos múltiples opciones de vehículos ideales para cada necesidad
                </p>
                <a
                    href="{{ $whatsappReservaUrl === '#' ? route('flota') : $whatsappReservaUrl }}"
                    @if($whatsappReservaUrl !== '#') target="_blank" rel="noopener noreferrer" @endif
                    class="inline-flex w-fit items-center justify-center gap-2.5 self-start rounded-full bg-brand-yellow px-7 py-3.5 text-sm font-semibold tracking-normal text-ink shadow-md transition hover:brightness-105 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-yellow focus-visible:ring-offset-2 focus-visible:ring-offset-brand-blue"
                >
                    <span>Escribir al WhatsApp</span>
                    <svg class="h-3.5 w-3.5 shrink-0 text-brand-blue" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </a>
            </div>

            <div class="relative isolate min-h-[17rem] w-full flex-1 lg:min-h-0">
                <img
                    src="{{ asset('img/cta-descubre-peru.png') }}"
                    alt="Rutas y paisajes del Perú para viajar en movilidad alquilada con chofer: consulta disponibilidad por WhatsApp con {{ config('app.name') }} en Cajamarca y todo el país." title="Rutas y paisajes del Perú para viajar en movilidad alquilada con chofer: consulta disponibilidad por WhatsApp con {{ config('app.name') }} en Cajamarca y todo el país."
                    width="1280"
                    height="720"
                    class="absolute inset-0 h-full w-full object-cover object-center"
                    loading="lazy"
                    decoding="async"
                    fetchpriority="low"
                >
                <div class="absolute inset-0 bg-brand-blue/45" aria-hidden="true"></div>

                <div class="pointer-events-none absolute inset-0 z-10 flex items-center justify-center px-6 py-10 md:px-10">
                    <div class="mx-auto max-w-lg text-center text-white">
                        <p class="text-base font-semibold tracking-wide drop-shadow-[0_2px_8px_rgba(0,0,0,0.45)] md:text-lg">Descubre la grandeza del</p>
                        <p class="my-2 text-4xl font-black uppercase leading-none tracking-tight drop-shadow-[0_4px_12px_rgba(0,0,0,0.5)] sm:my-3 md:text-6xl lg:text-7xl">PERÚ</p>
                        <p class="text-sm font-medium leading-snug text-white drop-shadow-[0_2px_8px_rgba(0,0,0,0.45)] md:text-base">
                            Viaja con la confianza y seguridad de {{ config('app.name') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
