<x-layouts.web :title="$movilidad->nombre . ' | ' . config('app.name')" :description="'Alquila ' . $movilidad->nombre . ' en Cajamarca y todo el Perú. ' . $movilidad->capacidad_pasajeros . ' pasajeros. Conductor privado disponible.'" :image="$movilidad->imagen_url">

<div class="bg-white min-h-screen py-10 md:py-16">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <x-movilidades.detalle :movilidad="$movilidad" />
    </div>
</div>

</x-layouts.web>
