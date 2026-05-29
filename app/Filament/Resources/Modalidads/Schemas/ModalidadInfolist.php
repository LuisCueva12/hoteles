<?php

namespace App\Filament\Resources\Modalidads\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ModalidadInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información de la Modalidad')
                    ->schema([
                        TextEntry::make('nombre')
                            ->label('Nombre'),

                        TextEntry::make('slug')
                            ->label('Slug'),

                        TextEntry::make('activo')
                            ->label('Estado')
                            ->badge()
                            ->color(fn (bool $state): string => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn (bool $state): string => $state ? 'Activo' : 'Inactivo'),

                        TextEntry::make('movilidades_count')
                            ->label('Total de Vehículos')
                            ->state(fn ($record) => $record->movilidades_count ?? 0),

                        TextEntry::make('created_at')
                            ->label('Fecha de Creación')
                            ->dateTime('d/m/Y H:i'),
                    ])
                    ->columns(2),
            ]);
    }
}
