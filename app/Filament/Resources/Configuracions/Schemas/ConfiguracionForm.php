<?php

namespace App\Filament\Resources\Configuracions\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ConfiguracionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('telefono_whatsapp')
                    ->label('Teléfono WhatsApp')
                    ->tel()
                    ->required()
                    ->maxLength(255)
                    ->placeholder('51987654321'),
                
                TextInput::make('enlace_facebook')
                    ->label('Enlace de Facebook')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://facebook.com/tu-pagina'),
                
                TextInput::make('enlace_instagram')
                    ->label('Enlace de Instagram')
                    ->url()
                    ->maxLength(255)
                    ->placeholder('https://instagram.com/tu-perfil'),
            ]);
    }
}
