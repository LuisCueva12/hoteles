<section class="bg-white py-16" aria-label="Promociones">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="grid grid-cols-1 gap-6 lg:grid-cols-2 lg:gap-8">

            <a href="{{ route('hoteles.catalogo') }}"
                class="group relative flex flex-col justify-between overflow-hidden rounded-2xl aspect-[640/360] shadow-lg ring-1 ring-black/5 hover:shadow-xl transition-shadow focus:outline-none"
                style="background: linear-gradient(135deg, #001f3f 0%, #003366 60%, #0055a5 100%);">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;)"></div>
                <div class="relative z-10 flex flex-col justify-center h-full px-8 py-8">
                    <p class="text-brand-yellow text-xs font-bold uppercase tracking-widest mb-3">Mejor precio garantizado</p>
                    <h3 class="text-white font-black text-3xl sm:text-4xl leading-tight uppercase mb-6">
                        Hoteles en<br>
                        <span class="text-brand-yellow">todo el Perú</span>
                    </h3>
                    <span class="inline-flex w-fit items-center gap-2 bg-brand-yellow text-brand-blue font-bold text-sm px-6 py-3 rounded-xl shadow group-hover:brightness-105 transition-all">
                        Ver hoteles
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="absolute right-0 bottom-0 w-48 h-48 rounded-full bg-white/5 translate-x-16 translate-y-16" aria-hidden="true"></div>
                <div class="absolute right-12 top-4 w-24 h-24 rounded-full bg-brand-yellow/10" aria-hidden="true"></div>
            </a>

            <a href="{{ route('hoteles.catalogo', ['categoria' => '5 Estrellas']) }}"
                class="group relative flex flex-col justify-between overflow-hidden rounded-2xl aspect-[640/360] shadow-lg ring-1 ring-black/5 hover:shadow-xl transition-shadow focus:outline-none"
                style="background: linear-gradient(135deg, #002b5c 0%, #004080 50%, #f5a800 100%);">
                <div class="absolute inset-0 opacity-10"
                    style="background-image: url(&quot;data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E&quot;)"></div>
                <div class="relative z-10 flex flex-col justify-center h-full px-8 py-8">
                    <p class="text-brand-yellow text-xs font-bold uppercase tracking-widest mb-3">Experiencia premium</p>
                    <h3 class="text-white font-black text-3xl sm:text-4xl leading-tight uppercase mb-6">
                        Hoteles<br>
                        <span class="text-brand-yellow">5 estrellas</span>
                    </h3>
                    <span class="inline-flex w-fit items-center gap-2 bg-brand-yellow text-brand-blue font-bold text-sm px-6 py-3 rounded-xl shadow group-hover:brightness-105 transition-all">
                        Ver lujo
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
                    </span>
                </div>
                <div class="absolute right-0 bottom-0 w-48 h-48 rounded-full bg-white/5 translate-x-16 translate-y-16" aria-hidden="true"></div>
                <div class="absolute right-12 top-4 w-24 h-24 rounded-full bg-white/10" aria-hidden="true"></div>
            </a>

        </div>
    </div>
</section>
