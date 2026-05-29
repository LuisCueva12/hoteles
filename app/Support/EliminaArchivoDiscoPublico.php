<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

final class EliminaArchivoDiscoPublico
{
    public static function ruta(?string $rutaRelativa): void
    {
        if ($rutaRelativa === null) {
            return;
        }

        $rutaRelativa = trim($rutaRelativa);
        if ($rutaRelativa === '') {
            return;
        }

        if (Str::startsWith($rutaRelativa, ['http://', 'https://'])) {
            return;
        }

        try {
            if (Storage::disk('public')->exists($rutaRelativa)) {
                Storage::disk('public')->delete($rutaRelativa);
            }
        } catch (\Throwable $e) {
            report($e);
        }
    }
}
