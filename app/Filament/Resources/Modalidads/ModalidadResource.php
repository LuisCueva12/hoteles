<?php

namespace App\Filament\Resources\Modalidads;

use App\Filament\Resources\Modalidads\Pages\CreateModalidad;
use App\Filament\Resources\Modalidads\Pages\EditModalidad;
use App\Filament\Resources\Modalidads\Pages\ListModalidads;
use App\Filament\Resources\Modalidads\Pages\ViewModalidad;
use App\Filament\Resources\Modalidads\Schemas\ModalidadForm;
use App\Filament\Resources\Modalidads\Schemas\ModalidadInfolist;
use App\Filament\Resources\Modalidads\Tables\ModalidadsTable;
use App\Models\Modalidad;
use BackedEnum;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ModalidadResource extends Resource
{
    protected static ?string $model = Modalidad::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-adjustments-horizontal';

    protected static ?string $navigationLabel = 'Modalidades';

    protected static ?string $modelLabel = 'Modalidad';

    protected static ?string $pluralModelLabel = 'Modalidades';

    protected static ?int $navigationSort = 3;

    public static function form(Schema $schema): Schema
    {
        return ModalidadForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ModalidadInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ModalidadsTable::configure($table);
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->withCount('movilidades');
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListModalidads::route('/'),
            'create' => CreateModalidad::route('/create'),
            'view' => ViewModalidad::route('/{record}'),
            'edit' => EditModalidad::route('/{record}/edit'),
        ];
    }
}
