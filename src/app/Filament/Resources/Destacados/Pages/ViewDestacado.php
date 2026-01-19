<?php

namespace App\Filament\Resources\Destacados\Pages;

use App\Filament\Resources\Destacados\DestacadoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDestacado extends ViewRecord
{
    protected static string $resource = DestacadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
