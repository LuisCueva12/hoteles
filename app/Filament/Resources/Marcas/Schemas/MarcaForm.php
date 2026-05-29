<?php

namespace App\Filament\Resources\Marcas\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MarcaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->label('Nombre de la Marca')
                    ->required()
                    ->maxLength(255),
                
                FileUpload::make('logo')
                    ->label('Logo de la Marca')
                    ->image()
                    ->directory('marcas/logos')
                    ->visibility('public')
                    ->disk('public')
                    ->maxSize(1024)
                    ->imageEditor()
                    ->imageResizeMode('contain')
                    ->imageCropAspectRatio('1:1')
                    ->imageResizeTargetWidth('200')
                    ->imageResizeTargetHeight('200')
                    ->helperText('Sube el logo de la marca (recomendado: 200x200px, formato PNG con fondo transparente)'),
                
                Toggle::make('activo')
                    ->label('Activo')
                    ->default(true),
            ]);
    }
}
