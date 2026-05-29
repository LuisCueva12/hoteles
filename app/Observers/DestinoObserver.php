<?php

namespace App\Observers;

use App\Models\Destino;
use App\Support\EliminaArchivoDiscoPublico;
use App\Support\LimpiezaArchivoSubidoTrasGuardar;

class DestinoObserver
{
    public function updating(Destino $destino): void
    {
        LimpiezaArchivoSubidoTrasGuardar::memorizarSiCambio($destino, 'imagen_url');
    }

    public function updated(Destino $destino): void
    {
        LimpiezaArchivoSubidoTrasGuardar::eliminarArchivoAnteriorSiAplica($destino, 'imagen_url');
    }

    public function deleting(Destino $destino): void
    {
        $ruta = $destino->imagen_url;
        EliminaArchivoDiscoPublico::ruta(is_string($ruta) ? $ruta : null);
    }
}
