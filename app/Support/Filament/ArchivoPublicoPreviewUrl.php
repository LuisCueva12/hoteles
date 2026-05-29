<?php

namespace App\Support\Filament;

use Filament\Forms\Components\BaseFileUpload;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\UnableToCheckFileExistence;
use Throwable;

final class ArchivoPublicoPreviewUrl
{
    public static function aplicarABaseFileUpload(BaseFileUpload $componente): void
    {
        $componente->getUploadedFileUsing(function (BaseFileUpload $component, string $file, string|array|null $storedFileNames): ?array {
            /** @var FilesystemAdapter $storage */
            $storage = $component->getDisk();

            $shouldFetchFileInformation = $component->shouldFetchFileInformation();

            if ($shouldFetchFileInformation) {
                try {
                    if (! $storage->exists($file)) {
                        return null;
                    }
                } catch (UnableToCheckFileExistence $exception) {
                    return null;
                }
            }

            $url = null;

            if ($component->getVisibility() === 'private') {
                try {
                    $url = $storage->temporaryUrl(
                        $file,
                        now()->addMinutes(30)->endOfHour(),
                    );
                } catch (Throwable $exception) {
                }
            }

            $url ??= self::urlDesdeOrigenPeticionActual($file);

            return [
                'name' => ($component->isMultiple() ? ($storedFileNames[$file] ?? null) : $storedFileNames) ?? basename($file),
                'size' => $shouldFetchFileInformation ? $storage->size($file) : 0,
                'type' => $shouldFetchFileInformation ? $storage->mimeType($file) : null,
                'url' => $url,
            ];
        });
    }

    public static function urlDesdeOrigenPeticionActual(string $rutaEnDiscoPublico): string
    {
        $ruta = ltrim($rutaEnDiscoPublico, '/');
        $request = request();

        if ($request !== null && $request->getSchemeAndHttpHost() !== '') {
            return rtrim($request->root(), '/').'/storage/'.$ruta;
        }

        return Storage::disk('public')->url($ruta);
    }
}
