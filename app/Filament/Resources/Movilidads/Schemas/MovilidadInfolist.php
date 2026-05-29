<?php

namespace App\Filament\Resources\Movilidads\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MovilidadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre')
                    ->label('Nombre del Vehículo'),
                ImageEntry::make('marca_logo')
                    ->label('Logo Marca')
                    ->getStateUsing(fn ($record) => $record->marca ? $record->marca->logo_url : null)
                    ->circular(),
                TextEntry::make('marca.nombre')
                    ->label('Marca'),
                TextEntry::make('categoria')
                    ->label('Categoría'),
                TextEntry::make('modalidades.nombre')
                    ->label('Modalidades')
                    ->badge(),
                TextEntry::make('ubicaciones.nombre')
                    ->label('Ubicaciones')
                    ->badge(),
                TextEntry::make('rutas.nombre')
                    ->label('Rutas Configuradas')
                    ->badge(),
                TextEntry::make('caracteristicas.nombre')
                    ->label('Características')
                    ->badge(),
                TextEntry::make('precio_base')
                    ->numeric()
                    ->prefix('S/. '),
                TextEntry::make('capacidad_pasajeros')
                    ->numeric(),
                ImageEntry::make('imagen_url')
                    ->label('Imagen del Vehículo')
                    ->getStateUsing(fn ($record) => $record->imagen_url),
                IconEntry::make('activo')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
