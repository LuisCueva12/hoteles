@props([
    'title' => null,
    'description' => null,
    'image' => null,
])
@php
    $brandName = config('app.name');
    $metaTitle = $title ?? $brandName . ' | Los Mejores Hoteles y Destinos del Perú';
    $metaDescription =
        $description ??
        'Reserva los mejores hoteles en los destinos más hermosos del Perú. Habitaciones cómodas, resorts y hoteles boutique con atención de primera clase.';
    $ogImage = $image ?? asset('img/logo.webp');
    $baseUrl = url('/');
    $structuredData = [
        '@context' => 'https://schema.org',
        '@graph' => [
            [
                '@type' => 'Organization',
                '@id' => $baseUrl . '#organization',
                'name' => $brandName,
                'legalName' => 'HORIZONTE ANDINO COMPANY E.I.R.L.',
                'url' => $baseUrl,
                'logo' => asset('img/logo.webp'),
                'email' => 'info@adventur.pe',
                'taxID' => '20612408255',
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => 'Jr. Amazonas 1079',
                    'addressLocality' => 'Cajamarca',
                    'addressRegion' => 'Cajamarca',
                    'addressCountry' => 'PE',
                ],
            ],
            [
                '@type' => 'WebSite',
                '@id' => $baseUrl . '#website',
                'url' => $baseUrl,
                'name' => $brandName,
                'description' => $metaDescription,
                'publisher' => ['@id' => $baseUrl . '#organization'],
                'inLanguage' => 'es-PE',
            ],
        ],
    ];
    if ($telefonoAtencionEtiqueta !== '') {
        $structuredData['@graph'][0]['telephone'] = $telefonoAtencionEtiqueta;
    }

    $whatsappPath =
        'M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.435 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z';

    $destinosGlobales = \App\Models\Destino::where('activo', true)->orderBy('nombre')->get();
@endphp
<!DOCTYPE html>
<html lang="es" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $metaDescription }}">
    <meta name="keywords"
        content="hoteles en cajamarca, reserva de hotel perú, hoteles boutique cajamarca, hoteles de lujo perú, alojamiento cajamarca, hoteles 5 estrellas perú, hospedaje corporativo perú, adventur">
    <title>{{ $metaTitle }}</title>
    <link rel="icon" type="image/webp" href="{{ asset('favicon.webp') }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="es_PE">
    <meta property="og:site_name" content="{{ $brandName }}">
    <meta property="og:title" content="{{ $metaTitle }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $metaTitle }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $ogImage }}">
    <script type="application/ld+json">{!! json_encode($structuredData, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}</script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>

<body class="bg-slate-50 text-slate-900 font-sans antialiased flex flex-col min-h-screen">

    <header class="absolute top-4 left-1/2 -translate-x-1/2 z-50 w-[calc(100%-2rem)] max-w-7xl bg-brand-blue/80 backdrop-blur-xl border border-white/15 shadow-2xl text-white rounded-2xl"
        role="banner">

        <div
            class="bg-brand-blue/65 text-white py-2 text-[0.75rem] border-b border-white/5 w-full rounded-t-2xl">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-row items-center justify-between gap-4 w-full">

                <div class="flex items-center gap-2 min-w-0">
                    <x-dynamic-component :component="'lucide-phone-call'" class="w-3.5 h-3.5 text-brand-yellow shrink-0"
                        stroke-width="2.5" />
                    <a href="{{ $whatsappReservaUrl }}" target="_blank" rel="noopener noreferrer"
                        class="flex items-center gap-1 hover:text-brand-yellow focus:outline-none transition-colors font-bold tabular-nums min-w-0">
                        <span class="font-medium text-white/95 hidden sm:inline whitespace-nowrap">Atención rápida por
                            WhatsApp:</span>
                        <span class="font-medium text-white/95 sm:hidden whitespace-nowrap">WhatsApp:</span>
                        <span class="truncate">{{ $telefonoAtencionEtiqueta }}</span>
                    </a>
                </div>

                <div class="flex items-center gap-4 sm:gap-6 shrink-0">
                    <nav class="hidden md:flex items-center gap-4 text-white/90 font-medium">
                        <a href="#servicios"
                            class="hover:text-brand-yellow focus:outline-none transition-colors">Corporativo</a>
                        <a href="#nosotros"
                            class="hover:text-brand-yellow focus:outline-none transition-colors">Familias</a>
                        <a href="#preguntas-frecuentes"
                            class="hover:text-brand-yellow focus:outline-none transition-colors">Grupos</a>
                    </nav>

                    <div class="flex items-center gap-3 border-l border-white/20 pl-4 sm:pl-6">
                        <span class="hidden sm:inline text-white/80 font-medium">Síguenos:</span>
                        <a href="{{ !empty($enlaceFacebook) ? $enlaceFacebook : '#' }}" target="_blank"
                            rel="noopener noreferrer" class="text-white hover:text-brand-yellow transition-colors"
                            aria-label="Facebook">
                            <x-dynamic-component :component="'lucide-facebook'" class="w-4.5 h-4.5" stroke-width="2" />
                        </a>
                        <a href="{{ !empty($enlaceInstagram) ? $enlaceInstagram : '#' }}" target="_blank"
                            rel="noopener noreferrer" class="text-white hover:text-brand-yellow transition-colors"
                            aria-label="Instagram">
                            <x-dynamic-component :component="'lucide-instagram'" class="w-4.5 h-4.5" stroke-width="2" />
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div
            class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center justify-between gap-4 min-h-[4.35rem] md:min-h-[5rem]">

            <a href="{{ route('inicio') }}" class="shrink-0 flex items-center bg-white/95 rounded-xl px-4 py-1.5 shadow-sm ring-1 ring-white/10 hover:scale-[1.02] transition-all"
                aria-label="{{ $brandName }} — Inicio">
                <img src="{{ asset('img/logo.webp') }}"
                    alt="{{ $brandName }} — Los mejores hoteles en Cajamarca y Perú"
                    title="{{ $brandName }} — Los mejores hoteles en Cajamarca y Perú" width="299"
                    height="300"
                    class="h-9 md:h-10 w-auto object-contain object-left hover:opacity-90 transition-opacity">
            </a>

            <nav class="hidden md:flex items-center justify-center flex-1 gap-6 lg:gap-8 text-white"
                aria-label="Navegación principal">

                <div class="relative group">
                    <button type="button"
                        class="flex items-center gap-1.5 py-3 focus:outline-none text-[0.85rem] lg:text-[0.9rem] font-semibold text-white hover:text-brand-yellow transition-all">
                        Destinos
                        <x-dynamic-component :component="'lucide-chevron-down'"
                            class="w-3.5 h-3.5 opacity-80 transition-transform group-hover:rotate-180"
                            stroke-width="2.5" />
                    </button>
                    <div
                        class="absolute left-1/2 -translate-x-1/2 top-full mt-1 w-[320px] sm:w-[480px] md:w-[560px] bg-white/98 backdrop-blur-xl border border-brand-blue/10 shadow-2xl rounded-2xl p-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                        <div class="mb-3.5 pb-2.5 border-b border-slate-100 flex items-center justify-between">
                            <span class="text-[0.95rem] font-semibold text-brand-blue">Destinos populares</span>
                            <span class="text-[10px] font-bold text-brand-blue bg-brand-yellow px-2.5 py-1 rounded-full uppercase">Perú</span>
                        </div>
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 max-h-80 overflow-y-auto pr-1">
                            @forelse($destinosGlobales as $destino)
                                <a href="{{ route('hoteles.catalogo', ['destino' => $destino->id]) }}"
                                    class="group/item flex flex-col p-3.5 rounded-xl bg-slate-50 border border-slate-100/80 hover:bg-brand-blue/[0.03] hover:border-brand-yellow hover:scale-[1.02] active:scale-[0.98] transition-all">
                                    <span class="text-[8px] uppercase tracking-wider font-extrabold text-slate-400 leading-none mb-1.5">{{ $destino->departamento ?: 'PERÚ' }}</span>
                                    <span class="text-sm font-bold text-brand-blue truncate group-hover/item:text-brand-yellow transition-colors capitalize">
                                        {{ $destino->nombre }}
                                    </span>
                                    <span class="text-[9px] font-bold text-brand-blue/50 group-hover/item:text-brand-yellow transition-colors mt-2">
                                        Ver hoteles →
                                    </span>
                                </a>
                            @empty
                                <div class="col-span-full py-6 text-center text-xs text-slate-400 italic">No hay destinos disponibles</div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <a href="{{ route('hoteles.catalogo') }}"
                    class="py-3 text-[0.85rem] lg:text-[0.9rem] font-semibold text-white hover:text-brand-yellow transition-all">
                    Hoteles
                </a>

                <a href="https://adventur.pe/blog" target="_blank" rel="noopener noreferrer"
                    class="py-3 text-[0.85rem] lg:text-[0.9rem] font-semibold text-white hover:text-brand-yellow transition-all">
                    Blog
                </a>

                <a href="{{ route('contacto') }}"
                    class="py-3 text-[0.85rem] lg:text-[0.9rem] font-semibold text-white hover:text-brand-yellow transition-all">
                    Contacto
                </a>

            </nav>

            <div class="flex items-center gap-2 ml-auto">
                <div class="flex items-center gap-3 sm:gap-2 mr-1">
                    <a href="#" onclick="cambiarIdiomaGTranslate('en'); return false;" class="hover:opacity-80 transition-opacity" title="English">
                        <img src="https://flagcdn.com/w40/gb.png"
                            class="w-6 h-auto sm:w-7 rounded-sm shadow-sm ring-1 ring-black/10 cursor-pointer" alt="English">
                    </a>
                    <a href="#" onclick="cambiarIdiomaGTranslate('es'); return false;" class="hover:opacity-80 transition-opacity" title="Español">
                        <img src="https://flagcdn.com/w40/pe.png"
                            class="w-6 h-auto sm:w-7 rounded-sm shadow-sm ring-1 ring-black/10 cursor-pointer" alt="Español">
                    </a>
                </div>

                <div class="hidden md:flex items-center shrink-0">
                    <a href="{{ $whatsappReservaUrl !== '#' ? $whatsappReservaUrl : route('hoteles.catalogo') }}"
                        @if ($whatsappReservaUrl !== '#') target="_blank" rel="noopener noreferrer" @endif
                        class="inline-flex items-center gap-2.5 rounded-lg bg-brand-yellow px-4 py-2.5 text-xs font-bold text-ink shadow-md border-b-2 border-brand-blue/10 transition hover:brightness-105 hover:scale-[1.02] active:scale-[0.98] focus:outline-none lg:px-6 lg:text-sm whitespace-nowrap">
                        Reservar Ahora
                        <svg class="h-4 w-4 shrink-0 text-ink lg:h-4.5 lg:w-4.5" viewBox="0 0 24 24"
                            fill="currentColor" aria-hidden="true">
                            <path d="{{ $whatsappPath }}" />
                        </svg>
                    </a>
                </div>

                <button type="button"
                    class="md:hidden text-white hover:bg-white/10 transition-colors p-2 rounded-lg -mr-1"
                    onclick="toggleMobileMenu(this)" aria-label="Abrir menú" aria-expanded="false"
                    aria-controls="mobile-menu">
                    <x-dynamic-component :component="'lucide-menu'" class="w-7 h-7" stroke-width="2" />
                </button>
            </div>
        </div>

        <div id="mobile-menu"
            class="hidden md:hidden absolute left-0 top-full w-full bg-white border-t border-brand-blue/10 shadow-xl"
            role="navigation" aria-label="Menú móvil">
            <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col gap-0.5 menu-text text-brand-blue">

                <a href="{{ route('hoteles.catalogo') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('hoteles.catalogo') && !request()->has('categoria') && !request()->has('destino') ? 'bg-brand-blue/10 text-brand-blue font-bold' : 'hover:bg-slate-100 text-slate-700 hover:text-brand-blue' }}"
                    onclick="toggleMobileMenu()">
                    <img src="{{ asset('iconos/hoteles.svg') }}" class="w-6 h-6 object-contain"
                        alt="Hoteles" title="Hoteles">
                    <span class="text-sm font-bold capitalize tracking-wide text-brand-blue">Hoteles</span>
                </a>

                <details class="group flex flex-col">
                    <summary
                        class="flex items-center justify-between px-3 py-3 rounded-xl text-slate-700 cursor-pointer list-none [&::-webkit-details-marker]:hidden {{ request()->has('destino') ? 'bg-brand-blue/5' : 'hover:bg-slate-100' }}">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('iconos/destinos-nacionales.svg') }}" class="w-6 h-6 object-contain"
                                alt="Destinos" title="Destinos">
                            <span class="text-sm font-bold capitalize tracking-wide text-brand-blue">Destinos</span>
                        </div>
                        <x-dynamic-component :component="'lucide-chevron-down'"
                            class="w-4 h-4 transition-transform group-open:rotate-180 text-slate-400"
                            stroke-width="2.5" />
                    </summary>
                    <div class="pl-12 pr-3 py-1 flex flex-col gap-1 border-l-2 border-brand-blue/10 ml-6 mb-2 mt-1">
                        @forelse($destinosGlobales as $destino)
                            <a href="{{ route('hoteles.catalogo', ['destino' => $destino->id]) }}"
                                class="py-2 text-sm font-semibold text-brand-blue transition-colors hover:text-brand-yellow capitalize"
                                onclick="toggleMobileMenu()">
                                {{ $destino->nombre }}
                            </a>
                        @empty
                            <span class="py-2 text-xs text-slate-400 italic">No hay destinos</span>
                        @endforelse
                    </div>
                </details>

                <a href="https://adventur.pe/blog" target="_blank" rel="noopener noreferrer"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl hover:bg-slate-100 text-slate-700 hover:text-brand-blue transition-colors"
                    onclick="toggleMobileMenu()">
                    <img src="{{ asset('iconos/blog.svg') }}" class="w-6 h-6 object-contain" alt="Blog"
                        title="Blog">
                    <span class="text-sm font-bold capitalize tracking-wide text-brand-blue">Blog</span>
                </a>

                <a href="{{ route('contacto') }}"
                    class="flex items-center gap-3 px-3 py-3 rounded-xl transition-colors {{ request()->routeIs('contacto') ? 'bg-brand-blue/10 text-brand-blue font-bold' : 'hover:bg-slate-100 text-slate-700 hover:text-brand-blue' }}"
                    onclick="toggleMobileMenu()">
                    <img src="{{ asset('iconos/contacto.svg') }}" class="w-6 h-6 object-contain" alt="Contacto"
                        title="Contacto">
                    <span class="text-sm font-bold capitalize tracking-wide text-brand-blue">Contacto</span>
                </a>
                <a href="{{ $whatsappReservaUrl !== '#' ? $whatsappReservaUrl : route('hoteles.catalogo') }}"
                    @if ($whatsappReservaUrl !== '#') target="_blank" rel="noopener noreferrer" @endif
                    class="mt-2 inline-flex w-full items-center justify-center gap-2 rounded-lg bg-brand-yellow px-4 py-3 text-sm font-semibold text-ink shadow-md ring-1 ring-brand-blue/15 transition hover:brightness-105"
                    onclick="toggleMobileMenu()">
                    Reservar Ahora
                    <svg class="h-5 w-5 shrink-0 text-ink" viewBox="0 0 24 24" fill="currentColor"
                        aria-hidden="true">
                        <path d="{{ $whatsappPath }}" />
                    </svg>
                </a>
            </div>
        </div>
    </header>

    <main class="grow w-full {{ request()->routeIs('inicio', 'hoteles.catalogo', 'contacto', 'hotel.detalle') ? '' : 'pt-[108px] md:pt-[128px]' }}" id="contenido-principal">
        {{ $slot }}
    </main>

    <footer class="border-t border-slate-200 bg-slate-100" role="contentinfo">
        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 pb-10 border-b border-slate-200">

                <div>
                    <img src="{{ asset('img/logo.webp') }}"
                        alt="{{ $brandName }} — Los mejores hoteles en Cajamarca y Perú"
                        title="{{ $brandName }} — Los mejores hoteles en Cajamarca y Perú" width="299"
                        height="300" class="h-24 w-auto object-contain mb-4">
                    <p class="text-slate-700 text-base leading-relaxed">HORIZONTE ANDINO COMPANY E.I.R.L.</p>
                    <p class="text-slate-700 text-base leading-relaxed">RUC: 20612408255</p>
                </div>

                <nav aria-label="Mapa del sitio">
                    <h3 class="text-label-upper text-brand-blue mb-4">Navegación</h3>
                    <ul class="space-y-3 text-base">
                        <li><a href="{{ route('inicio') }}"
                                class="{{ request()->routeIs('inicio') ? 'text-brand-yellow font-semibold' : 'text-slate-700 hover:text-brand-blue' }} transition-colors">Inicio</a>
                        </li>
                        <li><a href="{{ route('hoteles.catalogo') }}"
                                class="text-slate-700 hover:text-brand-blue transition-colors {{ request()->routeIs('hoteles.catalogo') ? 'text-brand-yellow font-semibold' : '' }}">Nuestros Hoteles</a></li>
                        <li><a href="#servicios"
                                class="text-slate-700 hover:text-brand-blue transition-colors">Servicios</a></li>
                        <li><a href="https://adventur.pe/blog" target="_blank" rel="noopener noreferrer"
                                class="text-slate-700 hover:text-brand-blue transition-colors">Blog</a></li>
                        <li><a href="#preguntas-frecuentes"
                                class="text-slate-700 hover:text-brand-blue transition-colors">Preguntas frecuentes</a>
                        </li>
                        <li><a href="{{ route('contacto') }}"
                                class="{{ request()->routeIs('contacto') ? 'text-brand-yellow font-semibold' : 'text-slate-700 hover:text-brand-blue' }} transition-colors">Contacto</a>
                        </li>
                    </ul>
                </nav>

                <div>
                    <h3 class="text-label-upper text-brand-blue mb-4">Contacto</h3>
                    <address class="not-italic">
                        <ul class="space-y-3 text-base text-slate-700">
                            @if ($telefonoAtencionEtiqueta !== '')
                                <li class="flex items-center gap-3">
                                    <svg class="w-5 h-5 text-brand-blue shrink-0" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <a href="{{ $telefonoAtencionHref }}"
                                        class="hover:text-brand-blue transition-colors tabular-nums">{{ $telefonoAtencionEtiqueta }}</a>
                                </li>
                            @endif
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-brand-blue shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <a href="mailto:info@adventur.pe"
                                    class="hover:text-brand-blue transition-colors">info@adventur.pe</a>
                            </li>
                            <li class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-brand-blue shrink-0" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Jr. Amazonas 1079</span>
                            </li>
                        </ul>
                    </address>
                </div>
            </div>

            <p class="text-center text-caption text-slate-600 mt-8">
                &copy; {{ date('Y') }} {{ $brandName }}. Todos los derechos reservados.
            </p>
        </div>
    </footer>

    <x-ui.toast />
    @stack('scripts')
    @include('components.partials.pasajeros-min-contador-script')
    <script>
        function toggleMobileMenu(btn) {
            const menu = document.getElementById('mobile-menu');
            const trigger = btn ?? document.querySelector('[aria-controls="mobile-menu"]');
            const hidden = menu.classList.toggle('hidden');
            if (trigger) trigger.setAttribute('aria-expanded', String(!hidden));
        }

        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobile-menu');
            const trigger = document.querySelector('[aria-controls="mobile-menu"]');
            if (menu && trigger && !menu.classList.contains('hidden')) {
                if (!menu.contains(event.target) && !trigger.contains(event.target)) {
                    toggleMobileMenu(trigger);
                }
            }
        });
    </script>

    <x-partials.floating-whatsapp />

    <div id="google_translate_element"></div>
    <script src="{{ asset('js/gtranslate-init.js') }}" defer></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" defer></script>
</body>

</html>
