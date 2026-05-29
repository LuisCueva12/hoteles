<?php

namespace App\Filament\Resources\Movilidads\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class MovilidadsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                ImageColumn::make('imagen_url')
                    ->label('Imagen')
                    ->circular()
                    ->defaultImageUrl(url('/placeholder.png'))
                    ->size(60),

                TextColumn::make('nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                ImageColumn::make('marca_logo')
                    ->label('Marca')
                    ->getStateUsing(fn ($record) => $record->marca ? $record->marca->logo_url : null)
                    ->circular()
                    ->size(30),
                TextColumn::make('marca.nombre')
                    ->label('Nombre Marca')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('categoria')
                    ->label('Categoría')
                    ->formatStateUsing(fn (string $state): string => ucfirst($state))
                    ->searchable()
                    ->sortable(),
                TextColumn::make('modalidades.nombre')
                    ->label('Modalidades')
                    ->badge()
                    ->searchable(),
                TextColumn::make('ubicaciones.nombre')
                    ->label('Ubicaciones')
                    ->badge()
                    ->searchable(),
                TextColumn::make('precio_base')
                    ->label('Precio')
                    ->formatStateUsing(fn ($state): string => 'S/. '.number_format($state, 2))
                    ->sortable(),
                TextColumn::make('capacidad_pasajeros')
                    ->label('Pasajeros')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('activo')
                    ->label('Estado')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
