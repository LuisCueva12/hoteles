<?php

namespace App\Filament\Resources\Configuracions\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ConfiguracionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('telefono_whatsapp'),
                TextEntry::make('enlace_facebook')
                    ->placeholder('-'),
                TextEntry::make('enlace_instagram')
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
            ]);
    }
}
