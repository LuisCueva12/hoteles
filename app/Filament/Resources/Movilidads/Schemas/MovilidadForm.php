<?php

namespace App\Filament\Resources\Movilidads\Schemas;

use App\Models\Ruta;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MovilidadForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                self::nombreField(),
                self::marcaField(),
                self::categoriaField(),
                self::modalidadField(),
                self::capacidadPasajerosField(),
                self::ubicacionesField(),
                self::precioBaseField(),
                self::caracteristicasField(),
                self::imagenField(),
                self::activoField(),
                self::rutasField(),
            ]);
    }

    private static function nombreField(): TextInput
    {
        return TextInput::make('nombre')
            ->label('Nombre del Vehículo')
            ->required()
            ->maxLength(255);
    }

    private static function marcaField(): Select
    {
        return Select::make('marca_id')
            ->label('Marca')
            ->relationship('marca', 'nombre')
            ->searchable()
            ->preload()
            ->required();
    }

    private static function categoriaField(): Select
    {
        return Select::make('categoria')
            ->label('Categoría')
            ->options(function () {
                return \App\Models\Categoria::pluck('nombre', 'nombre')->toArray();
            })
            ->searchable()
            ->preload()
            ->required();
    }

    private static function modalidadField(): Select
    {
        return Select::make('modalidades')
            ->label('Modalidades')
            ->multiple()
            ->relationship('modalidades', 'nombre')
            ->preload()
            ->searchable()
            ->required()
            ->helperText('Selecciona las modalidades disponibles para este vehículo.');
    }

    private static function ubicacionesField(): Select
    {
        return Select::make('ubicaciones')
            ->label('Ubicaciones Disponibles')
            ->multiple()
            ->relationship('ubicaciones', 'nombre')
            ->preload()
            ->searchable()
            ->required()
            ->helperText('Selecciona las ubicaciones donde este vehículo está disponible');
    }

    private static function rutasField(): Repeater
    {
        return Repeater::make('movilidadRutas')
            ->label('Rutas y Precios')
            ->relationship('movilidadRutas')
            ->schema([
                Select::make('ruta_id')
                    ->label('Ruta')
                    ->options(Ruta::where('activo', true)->pluck('nombre', 'id'))
                    ->required()
                    ->searchable()
                    ->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                TextInput::make('precio_ruta')
                    ->label('Precio para esta Ruta')
                    ->prefix('S/.')
                    ->numeric()
                    ->required()
                    ->step(0.01)
                    ->helperText('Precio específico para esta ruta'),
            ])
            ->columns(2)
            ->defaultItems(0)
            ->addActionLabel('Agregar Ruta')
            ->helperText('Define las rutas específicas y sus precios para este vehículo');
    }

    private static function precioBaseField(): TextInput
    {
        return TextInput::make('precio_base')
            ->label('Precio Base')
            ->prefix('S/.')
            ->numeric()
            ->required()
            ->step(0.01);
    }

    private static function capacidadPasajerosField(): TextInput
    {
        return TextInput::make('capacidad_pasajeros')
            ->label('Capacidad de Pasajeros')
            ->numeric()
            ->required()
            ->minValue(1)
            ->maxValue(80);
    }

    private static function caracteristicasField(): Select
    {
        return Select::make('caracteristicas')
            ->label('Características')
            ->multiple()
            ->relationship('caracteristicas', 'nombre')
            ->preload()
            ->searchable()
            ->createOptionForm([
                TextInput::make('nombre')
                    ->label('Nombre de la Característica')
                    ->required()
                    ->maxLength(255)
                    ->unique('caracteristicas', 'nombre'),
            ])
            ->helperText('Selecciona o crea características para este vehículo.');
    }

    private static function imagenField(): FileUpload
    {
        return FileUpload::make('ruta_imagen')
            ->label('Imagen del Vehículo')
            ->image()
            ->directory('movilidades')
            ->visibility('public')
            ->disk('public')
            ->maxSize(2048)
            ->imageEditor()
            ->required(fn (string $context): bool => $context === 'create');
    }

    private static function activoField(): Toggle
    {
        return Toggle::make('activo')
            ->label('Activo')
            ->default(true);
    }
}
