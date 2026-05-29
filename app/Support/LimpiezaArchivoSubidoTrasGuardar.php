<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;

final class LimpiezaArchivoSubidoTrasGuardar
{
    private static array $valoresAnteriores = [];

    public static function memorizarSiCambio(Model $modelo, string $atributo): void
    {
        if (! $modelo->isDirty($atributo)) {
            return;
        }

        $oid = spl_object_id($modelo);
        self::$valoresAnteriores[$oid] ??= [];
        self::$valoresAnteriores[$oid][$atributo] = $modelo->getOriginal($atributo);
    }

    public static function eliminarArchivoAnteriorSiAplica(Model $modelo, string $atributo): void
    {
        $oid = spl_object_id($modelo);
        if (! isset(self::$valoresAnteriores[$oid][$atributo])) {
            return;
        }

        $anterior = self::$valoresAnteriores[$oid][$atributo];
        unset(self::$valoresAnteriores[$oid][$atributo]);
        if (self::$valoresAnteriores[$oid] === []) {
            unset(self::$valoresAnteriores[$oid]);
        }

        if (! is_string($anterior) && $anterior !== null) {
            return;
        }

        $anterior = $anterior !== null ? trim($anterior) : '';
        $actual = $modelo->getAttribute($atributo);
        $actual = is_string($actual) ? trim($actual) : $actual;

        if ($anterior !== '' && $anterior !== $actual) {
            EliminaArchivoDiscoPublico::ruta($anterior);
        }
    }
}
