<?php

namespace App\Filament\Resources\Destacados\Pages;

use App\Filament\Resources\Destacados\DestacadoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDestacados extends ListRecords
{
    protected static string $resource = DestacadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
