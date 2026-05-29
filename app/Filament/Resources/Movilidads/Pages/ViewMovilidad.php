<?php

namespace App\Filament\Resources\Movilidads\Pages;

use App\Filament\Resources\Movilidads\MovilidadResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewMovilidad extends ViewRecord
{
    protected static string $resource = MovilidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
