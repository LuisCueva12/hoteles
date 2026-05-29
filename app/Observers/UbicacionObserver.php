<?php

namespace App\Observers;

use App\Models\Ubicacion;
use App\Support\EliminaArchivoDiscoPublico;
use App\Support\LimpiezaArchivoSubidoTrasGuardar;

class UbicacionObserver
{
    public function deleting(Ubicacion $ubicacion): void
    {
        $ruta = $ubicacion->ruta_imagen;
        EliminaArchivoDiscoPublico::ruta(is_string($ruta) ? $ruta : null);
    }

    public function updating(Ubicacion $ubicacion): void
    {
        LimpiezaArchivoSubidoTrasGuardar::memorizarSiCambio($ubicacion, 'ruta_imagen');
    }

    public function updated(Ubicacion $ubicacion): void
    {
        LimpiezaArchivoSubidoTrasGuardar::eliminarArchivoAnteriorSiAplica($ubicacion, 'ruta_imagen');
    }
}
