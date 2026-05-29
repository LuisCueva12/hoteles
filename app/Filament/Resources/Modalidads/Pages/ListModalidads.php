<?php

namespace App\Filament\Resources\Modalidads\Pages;

use App\Filament\Resources\Modalidads\ModalidadResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListModalidads extends ListRecords
{
    protected static string $resource = ModalidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
