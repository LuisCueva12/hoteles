<?php

namespace App\Filament\Resources\Movilidads;

use App\Filament\Resources\Movilidads\Pages\CreateMovilidad;
use App\Filament\Resources\Movilidads\Pages\EditMovilidad;
use App\Filament\Resources\Movilidads\Pages\ListMovilidads;
use App\Filament\Resources\Movilidads\Pages\ViewMovilidad;
use App\Filament\Resources\Movilidads\Schemas\MovilidadForm;
use App\Filament\Resources\Movilidads\Schemas\MovilidadInfolist;
use App\Filament\Resources\Movilidads\Tables\MovilidadsTable;
use App\Models\Movilidad;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MovilidadResource extends Resource
{
    protected static ?string $model = Movilidad::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationLabel = 'Movilidades';
    protected static ?string $modelLabel = 'Movilidad';
    protected static ?string $pluralModelLabel = 'Movilidades';
    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return MovilidadForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return MovilidadInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MovilidadsTable::configure($table);
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
            'index' => ListMovilidads::route('/'),
            'create' => CreateMovilidad::route('/create'),
            'view' => ViewMovilidad::route('/{record}'),
            'edit' => EditMovilidad::route('/{record}/edit'),
        ];
    }
}
