<?php

namespace App\Observers;

use App\Models\Movilidad;
use App\Support\EliminaArchivoDiscoPublico;
use App\Support\LimpiezaArchivoSubidoTrasGuardar;

class MovilidadObserver
{
    public function updating(Movilidad $movilidad): void
    {
        LimpiezaArchivoSubidoTrasGuardar::memorizarSiCambio($movilidad, 'ruta_imagen');
    }

    public function updated(Movilidad $movilidad): void
    {
        LimpiezaArchivoSubidoTrasGuardar::eliminarArchivoAnteriorSiAplica($movilidad, 'ruta_imagen');
    }

    public function deleting(Movilidad $movilidad): void
    {
        $ruta = $movilidad->ruta_imagen;
        EliminaArchivoDiscoPublico::ruta(is_string($ruta) ? $ruta : null);
    }
}
