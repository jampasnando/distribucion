<?php

namespace App\Filament\Resources\Carrusels\Pages;

use App\Filament\Resources\Carrusels\CarruselResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewCarrusel extends ViewRecord
{
    protected static string $resource = CarruselResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
