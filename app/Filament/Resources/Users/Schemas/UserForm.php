<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre_completo')
                    ->label('Nombre Completo')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),
                
                Select::make('rol')
                    ->label('Rol')
                    ->options([
                        'admin' => 'Administrador',
                        'editor' => 'Editor',
                    ])
                    ->required()
                    ->default('admin'),
                
                TextInput::make('password')
                    ->label('Contraseña')
                    ->password()
                    ->required(fn ($context) => $context === 'create')
                    ->dehydrated(fn ($state) => filled($state))
                    ->minLength(8)
                    ->maxLength(255),
            ]);
    }
}
