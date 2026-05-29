<?php

namespace App\Filament\Resources\Modalidads\Pages;

use App\Filament\Resources\Modalidads\ModalidadResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditModalidad extends EditRecord
{
    protected static string $resource = ModalidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
