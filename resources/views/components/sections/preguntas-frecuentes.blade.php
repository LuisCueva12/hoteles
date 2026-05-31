<section id="preguntas-frecuentes" class="bg-white py-16" aria-labelledby="faq-titulo">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
        <header class="text-center mb-12">
            <h2 id="faq-titulo" class="section-title leading-tight tracking-tight mb-4">
                <span class="text-brand-blue">Preguntas frecuentes</span>
                <span class="text-brand-yellow"> sobre reserva de hoteles</span>
            </h2>
            <p class="text-ink text-body-16 font-medium max-w-xl mx-auto">
                Información clara sobre reservas, disponibilidad y tipos de alojamiento para tu estadía en Cajamarca y en todo el Perú.
            </p>
        </header>

        @php
            $preguntas = [
                [
                    'pregunta' => '¿Qué documentos necesito para reservar un hotel?',
                    'respuesta' => 'Para reservar un hotel solo necesitas tu documento de identidad (DNI o pasaporte) al momento del check-in. La reserva se realiza a través de WhatsApp o nuestro formulario en línea, y tus datos personales se tratan de forma confidencial conforme a nuestra política de privacidad: se utilizan exclusivamente para la gestión del alojamiento, sin compartirse con terceros sin tu autorización.',
                ],
                [
                    'pregunta' => '¿Mis datos personales están seguros al hacer una reserva?',
                    'respuesta' => 'Sí. Protegemos tu información bajo estándares de confidencialidad y seguridad. Los datos se usan únicamente para gestionar tu reserva y no se comparten con terceros sin tu consentimiento previo.',
                ],
                [
                    'pregunta' => '¿Qué tipos de alojamiento ofrecen?',
                    'respuesta' => 'Contamos con hoteles de 3, 4 y 5 estrellas, hoteles boutique y resorts en los principales destinos del Perú. Todos verificados y con habitaciones cómodas, ubicaciones convenientes y atención personalizada. Puedes filtrar por categoría, destino y capacidad desde nuestro catálogo.',
                ],
            ];
        @endphp

        <div class="space-y-3">
            @foreach($preguntas as $item)
                <div class="faq-item">
                    <details name="faq">
                        <summary>{{ $item['pregunta'] }}</summary>
                        <p class="faq-answer">{{ $item['respuesta'] }}</p>
                    </details>
                </div>
            @endforeach
        </div>
    </div>
</section>
