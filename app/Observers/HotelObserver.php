<?php

namespace App\Observers;

use App\Models\Hotel;
use App\Support\EliminaArchivoDiscoPublico;
use App\Support\LimpiezaArchivoSubidoTrasGuardar;

class HotelObserver
{
    public function updating(Hotel $hotel): void
    {
        LimpiezaArchivoSubidoTrasGuardar::memorizarSiCambio($hotel, 'ruta_imagen');
    }

    public function updated(Hotel $hotel): void
    {
        LimpiezaArchivoSubidoTrasGuardar::eliminarArchivoAnteriorSiAplica($hotel, 'ruta_imagen');
    }

    public function deleting(Hotel $hotel): void
    {
        $ruta = $hotel->ruta_imagen;
        EliminaArchivoDiscoPublico::ruta(is_string($ruta) ? $ruta : null);
    }
}
