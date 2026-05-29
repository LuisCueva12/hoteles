<x-layouts.web :title="$hotel->nombre . ' | ' . config('app.name')" :description="'Reserva estadías en ' . $hotel->nombre . ' en todo el Perú. Capacidad para ' . $hotel->capacidad_personas . ' huéspedes. Alojamiento verificado.'" :image="$hotel->imagen_url">

<div class="bg-white min-h-screen py-10 md:py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <x-hoteles.detalle :hotel="$hotel" />
    </div>
</div>

</x-layouts.web>
