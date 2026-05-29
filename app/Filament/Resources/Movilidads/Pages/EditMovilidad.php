<?php

namespace App\Filament\Resources\Movilidads\Pages;

use App\Filament\Resources\Movilidads\MovilidadResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditMovilidad extends EditRecord
{
    protected static string $resource = MovilidadResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
