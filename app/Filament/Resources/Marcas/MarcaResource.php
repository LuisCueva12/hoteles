<?php

namespace App\Filament\Resources\Marcas;

use App\Filament\Resources\Marcas\Pages\CreateMarca;
use App\Filament\Resources\Marcas\Pages\EditMarca;
use App\Filament\Resources\Marcas\Pages\ListMarcas;
use App\Filament\Resources\Marcas\Pages\ViewMarca;
use App\Filament\Resources\Marcas\Schemas\MarcaForm;
use App\Filament\Resources\Marcas\Schemas\MarcaInfolist;
use App\Filament\Resources\Marcas\Tables\MarcasTable;
use App\Models\Marca;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MarcaResource extends Resource
{
    protected static ?string $model = Marca::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-building-storefront';

    protected static ?string $navigationLabel = 'Marcas';

    protected static ?string $modelLabel = 'Marca';

    protected static ?string $pluralModelLabel = 'Marcas';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MarcaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MarcaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MarcasTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('hoteles');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMarcas::route('/'),
            'create' => CreateMarca::route('/create'),
            'view' => ViewMarca::route('/{record}'),
            'edit' => EditMarca::route('/{record}/edit'),
        ];
    }
}
