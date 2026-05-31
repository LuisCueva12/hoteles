<x-layouts.web title="Contacto - {{ config('app.name') }}"
    description="Ponte en contacto con nosotros para reservas de hotel, consultas de alojamiento y servicios turísticos en Cajamarca y todo el Perú.">

    <section class="relative isolate w-full overflow-hidden bg-brand-blue -mt-[108px] md:-mt-[128px] min-h-[280px] md:min-h-[300px] flex items-end">
        <img src="{{ asset('img/hero-principal-2.webp') }}" alt="Contacto {{ config('app.name') }}"
            class="absolute inset-0 w-full h-full object-cover object-center">
        <div class="absolute inset-0 bg-gradient-to-t from-brand-blue/90 via-brand-blue/55 to-brand-blue/30" aria-hidden="true"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 lg:px-8 text-center pb-10 pt-[140px] md:pt-[160px]">
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-extrabold leading-tight tracking-tight mb-3">
                <span class="text-white">Ponte en</span> <span class="text-brand-yellow">contacto</span>
            </h1>
            <p class="text-white/75 text-sm font-medium">
                Escríbenos y recibe una respuesta personalizada en minutos.
            </p>
        </div>
    </section>

    <section class="py-10 md:py-16 bg-slate-50 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="bg-white rounded-2xl shadow-xl border border-slate-100 overflow-hidden">
                <div class="flex flex-col lg:flex-row min-h-[500px]">

                    <div class="w-full lg:w-[55%] p-6 md:p-10">
                        <div class="mb-8">
                            <h2 class="text-2xl font-bold text-brand-blue mb-2 capitalize">Envíanos un mensaje</h2>
                            <div class="h-1 w-12 bg-brand-yellow rounded-full"></div>
                        </div>

                        <form id="contact-form" action="{{ config('services.formtorch.endpoint') }}" method="POST"
                            class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <input type="hidden" name="_subject" value="Nuevo Mensaje desde la Web Adventur">

                            <div class="space-y-1">
                                <label for="name"
                                    class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-widest ml-1">Nombre</label>
                                <input type="text" id="name" name="name" required
                                    class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-blue/10 focus:border-brand-blue transition-all text-slate-700 text-sm font-semibold"
                                    placeholder="Nombre completo">
                            </div>
                            <div class="space-y-1">
                                <label for="email"
                                    class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-widest ml-1">Correo</label>
                                <input type="email" id="email" name="email" required
                                    class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-blue/10 focus:border-brand-blue transition-all text-slate-700 text-sm font-semibold"
                                    placeholder="correo@ejemplo.com">
                            </div>

                            <div class="space-y-1">
                                <label for="phone"
                                    class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-widest ml-1">WhatsApp</label>
                                <input type="tel" id="phone" name="phone"
                                    class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-blue/10 focus:border-brand-blue transition-all text-slate-700 text-sm font-semibold"
                                    placeholder="+51 999 999 999">
                            </div>
                            <div class="space-y-1">
                                <label for="subject"
                                    class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-widest ml-1">Asunto</label>
                                <div class="relative">
                                    <select id="subject" name="subject" required
                                        class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-blue/10 focus:border-brand-blue transition-all text-slate-700 text-sm font-semibold appearance-none cursor-pointer">
                                        <option value="">Selecciona</option>
                                        <option value="reserva-hotel">Reserva de Hotel</option>
                                        <option value="hospedaje-corporativo">Hospedaje Corporativo</option>
                                        <option value="grupos-eventos">Grupos y Eventos</option>
                                        <option value="turistico">Turismo</option>
                                    </select>
                                    <div
                                        class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <x-dynamic-component :component="'lucide-chevron-down'" class="w-4 h-4" />
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2 space-y-1">
                                <label for="message"
                                    class="text-[0.6rem] font-bold text-slate-400 uppercase tracking-widest ml-1">Mensaje</label>
                                <textarea id="message" name="message" rows="3" required
                                    class="w-full px-5 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-brand-blue/10 focus:border-brand-blue transition-all text-slate-700 text-sm font-semibold resize-none"
                                    placeholder="Tu mensaje..."></textarea>
                            </div>

                            <div class="md:col-span-2 pt-2">
                                <button type="submit" id="submit-btn"
                                    class="w-full md:w-auto bg-brand-yellow text-brand-blue font-bold py-3.5 px-10 rounded-xl shadow-lg shadow-brand-yellow/20 hover:bg-yellow-400 active:scale-[0.98] transition-all flex items-center justify-center gap-2 group">
                                    <x-dynamic-component :component="'lucide-send'"
                                        class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform"
                                        stroke-width="3" />
                                    Enviar Mensaje
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="w-full lg:w-[45%] flex flex-col bg-slate-50 border-l border-slate-100">
                        <div class="p-6 md:p-10 bg-brand-blue text-white relative overflow-hidden">
                            <div class="relative z-10 space-y-6">
                                <h3 class="text-lg font-bold">Atención al cliente</h3>
                                <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                                            <x-dynamic-component :component="'lucide-phone'" class="w-4 h-4 text-brand-yellow" />
                                        </div>
                                        <a href="tel:{{ str_replace(' ', '', $telefonoAtencionEtiqueta) }}"
                                            class="text-sm font-bold hover:text-brand-yellow transition-colors tabular-nums">{{ $telefonoAtencionEtiqueta }}</a>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                                            <x-dynamic-component :component="'lucide-mail'" class="w-4 h-4 text-brand-yellow" />
                                        </div>
                                        <a href="mailto:info@adventur.pe"
                                            class="text-sm font-bold hover:text-brand-yellow transition-colors">info@adventur.pe</a>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-8 h-8 bg-white/10 rounded-lg flex items-center justify-center shrink-0">
                                            <x-dynamic-component :component="'lucide-map-pin'" class="w-4 h-4 text-brand-yellow" />
                                        </div>
                                        <p class="text-sm font-bold">Jr. Amazonas 1079, Cajamarca</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div
                            class="grow relative min-h-[250px] grayscale hover:grayscale-0 transition-all duration-700">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3958.8465646141386!2d-78.5147!3d-7.1587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91b25af68413fb5f%3A0x6bba3bc30a9163d7!2sJr.%20Amazonas%201079%2C%20Cajamarca!5e0!3m2!1ses!2spe!4v1700000000000!5m2!1ses!2spe"
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                                class="absolute inset-0">
                            </iframe>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            document.getElementById('contact-form')?.addEventListener('submit', function(e) {
                e.preventDefault();
                const form = e.target;
                const btn = document.getElementById('submit-btn');

                const email = form.querySelector('#email').value;
                const phone = form.querySelector('#phone').value;

                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(email)) {
                    alert('Por favor, ingresa un correo electrónico válido.');
                    return;
                }

                const cleanPhone = phone.replace(/[^\d+]/g, '');
                if (cleanPhone.length < 7 || cleanPhone.length > 15) {
                    alert('Por favor, ingresa un número de teléfono válido (incluyendo código de país si es necesario).');
                    return;
                }

                if (!form.action || form.action.includes('tu-id-aqui')) {
                    alert('Configura tu ID de FormTorch en el archivo .env');
                    return;
                }

                btn.disabled = true;
                btn.innerHTML = 'Enviando...';

                fetch(form.action, {
                        method: 'POST',
                        body: new FormData(form),
                        headers: {
                            'Accept': 'application/json'
                        }
                    })
                    .then(res => {
                        form.reset();
                        if (window.showToast) window.showToast("¡Mensaje enviado correctamente!");
                    })
                    .catch(err => alert('Error al enviar el mensaje. Intente de nuevo.'))
                    .finally(() => {
                        btn.disabled = false;
                        btn.innerHTML = `
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 group-hover:-translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="3"><path d="M22 2L11 13M22 2l-7 20-4-9-9-4 20-7z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Enviar Mensaje
                `;
                    });
            });
        </script>
    @endpush
</x-layouts.web>
