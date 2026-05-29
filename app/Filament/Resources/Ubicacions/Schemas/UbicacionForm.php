<?php

namespace App\Filament\Resources\Ubicacions\Schemas;

use App\Support\Filament\ArchivoPublicoPreviewUrl;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class UbicacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                self::imagenCiudadField(),
                Toggle::make('activo')
                    ->required(),
            ]);
    }

    private static function imagenCiudadField(): FileUpload
    {
        $campo = FileUpload::make('ruta_imagen')
            ->label('Imagen de la Ciudad')
            ->image()
            ->directory('ubicaciones')
            ->visibility('public')
            ->disk('public')
            ->maxSize(2048)
            ->imageEditor();

        ArchivoPublicoPreviewUrl::aplicarABaseFileUpload($campo);

        return $campo;
    }
}
