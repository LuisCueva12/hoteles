<section class="bg-white py-16" aria-label="Promociones">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-8">
            <a
                href="{{ route('flota') }}"
                class="group relative block w-full max-w-[640px] justify-self-center overflow-hidden rounded-2xl shadow-lg shadow-brand-blue/10 ring-1 ring-black/5 transition-shadow hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-yellow focus-visible:ring-offset-2 aspect-[640/360] lg:max-w-none lg:justify-self-stretch"
            >
                <img
                    src="{{ asset('img/promo-banner-1.webp') }}"
                    alt="Promoción {{ config('app.name') }}" title="Promoción {{ config('app.name') }}"
                    width="640"
                    height="360"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-500 ease-out group-hover:scale-[1.03]"
                    loading="lazy"
                    decoding="async"
                    sizes="(max-width: 1023px) min(100vw, 640px), 50vw"
                >
            </a>
            <a
                href="{{ route('flota') }}"
                class="group relative block w-full max-w-[640px] justify-self-center overflow-hidden rounded-2xl shadow-lg shadow-brand-blue/10 ring-1 ring-black/5 transition-shadow hover:shadow-xl focus:outline-none focus-visible:ring-2 focus-visible:ring-brand-yellow focus-visible:ring-offset-2 aspect-[640/360] lg:max-w-none lg:justify-self-stretch"
            >
                <img
                    src="{{ asset('img/promo-banner-2.webp') }}"
                    alt="Promoción {{ config('app.name') }}" title="Promoción {{ config('app.name') }}"
                    width="640"
                    height="360"
                    class="absolute inset-0 h-full w-full object-cover object-center transition duration-500 ease-out group-hover:scale-[1.03]"
                    loading="lazy"
                    decoding="async"
                    sizes="(max-width: 1023px) min(100vw, 640px), 50vw"
                >
            </a>
        </div>
    </div>
</section>
