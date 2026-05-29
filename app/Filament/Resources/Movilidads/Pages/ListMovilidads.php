<?php

namespace App\Filament\Resources\Movilidads\Pages;

use App\Filament\Resources\Movilidads\MovilidadResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMovilidads extends ListRecords
{
    protected static string $resource = MovilidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
