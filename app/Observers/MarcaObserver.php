<?php

namespace App\Observers;

use App\Models\Marca;
use App\Models\Hotel;
use App\Support\EliminaArchivoDiscoPublico;
use App\Support\LimpiezaArchivoSubidoTrasGuardar;

class MarcaObserver
{
    public function deleting(Marca $marca): void
    {
        $marca->hoteles()->each(function (Hotel $hotel): void {
            $hotel->delete();
        });

        $logo = $marca->logo;
        EliminaArchivoDiscoPublico::ruta(is_string($logo) ? $logo : null);
    }

    public function updating(Marca $marca): void
    {
        LimpiezaArchivoSubidoTrasGuardar::memorizarSiCambio($marca, 'logo');
    }

    public function updated(Marca $marca): void
    {
        LimpiezaArchivoSubidoTrasGuardar::eliminarArchivoAnteriorSiAplica($marca, 'logo');
    }
}
