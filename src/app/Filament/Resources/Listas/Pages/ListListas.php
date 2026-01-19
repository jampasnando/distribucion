<?php

namespace App\Filament\Resources\Listas\Pages;

use App\Filament\Resources\Listas\ListaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListListas extends ListRecords
{
    protected static string $resource = ListaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
