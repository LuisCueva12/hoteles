<section id="preguntas-frecuentes" class="bg-white py-16" aria-labelledby="faq-titulo">
    <div class="max-w-3xl mx-auto px-6 lg:px-8">
        <header class="text-center mb-12">
            <h2 id="faq-titulo" class="section-title leading-tight tracking-tight mb-4">
                <span class="text-brand-blue">Preguntas frecuentes</span>
                <span class="text-brand-yellow"> sobre alquiler de movilidad</span>
            </h2>
            <p class="text-ink text-body-16 font-medium max-w-xl mx-auto">
                Información clara sobre documentos, privacidad y modalidad de servicio para tu reserva en Cajamarca y en todo el Perú.
            </p>
        </header>

        @php
            $preguntas = [
                [
                    'pregunta' => '¿Qué documentos necesito para alquilar un vehículo y cómo protegen mis datos?',
                    'respuesta' => 'Para alquilar una movilidad solo necesitas presentar tu documento de identidad, requerido para el registro de la reserva. La información personal se trata de forma confidencial y conforme a nuestra política de protección de datos: se utiliza exclusivamente para reserva, facturación y coordinación del servicio, sin compartirse con terceros sin tu autorización.',
                ],
                [
                    'pregunta' => '¿Mis datos personales están seguros al realizar una reserva?',
                    'respuesta' => 'Sí. Protegemos tu información bajo estándares de confidencialidad y seguridad. Los datos se usan únicamente para la gestión del servicio solicitado y no se comparten con terceros sin tu consentimiento previo.',
                ],
                [
                    'pregunta' => '¿Qué modalidades de servicio ofrecen para el alquiler de movilidades?',
                    'respuesta' => 'Ofrecemos movilidades con conductor profesional, con puntualidad y seguridad en cada traslado. Ideal para transporte corporativo, turístico y privado en Cajamarca y a nivel nacional.',
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
