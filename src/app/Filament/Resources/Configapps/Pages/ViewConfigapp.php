<?php

namespace App\Filament\Resources\Configapps\Pages;

use App\Filament\Resources\Configapps\ConfigappResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewConfigapp extends ViewRecord
{
    protected static string $resource = ConfigappResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
