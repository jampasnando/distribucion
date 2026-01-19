<?php

namespace App\Filament\Resources\Destacado2s\Pages;

use App\Filament\Resources\Destacado2s\Destacado2Resource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewDestacado2 extends ViewRecord
{
    protected static string $resource = Destacado2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
