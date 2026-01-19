<?php

namespace App\Filament\Resources\Listas\Pages;

use App\Filament\Resources\Listas\ListaResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewLista extends ViewRecord
{
    protected static string $resource = ListaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
