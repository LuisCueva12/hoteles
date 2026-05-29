<?php

namespace App\Filament\Resources\Modalidads\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ModalidadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre de la Modalidad')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),

                Toggle::make('activo')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}
