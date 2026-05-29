<?php

namespace App\Filament\Resources\Modalidads\Pages;

use App\Filament\Resources\Modalidads\ModalidadResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewModalidad extends ViewRecord
{
    protected static string $resource = ModalidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
