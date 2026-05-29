<?php

namespace App\Filament\Resources\Caracteristicas;

use App\Filament\Resources\Caracteristicas\Pages\ListCaracteristicas;
use App\Models\Caracteristica;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;

class CaracteristicaResource extends Resource
{
    protected static ?string $model = Caracteristica::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-sparkles';

    protected static ?string $navigationLabel = 'Características';

    protected static ?string $modelLabel = 'Característica';

    protected static ?string $pluralModelLabel = 'Características';

    protected static ?int $navigationSort = 4;

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('movilidades_count')
                    ->label('Vehículos')
                    ->counts('movilidades')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->recordActions([
                DeleteAction::make()
                    ->requiresConfirmation(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCaracteristicas::route('/'),
        ];
    }
}
