<?php

namespace App\Filament\Resources\Destacado2s\Pages;

use App\Filament\Resources\Destacado2s\Destacado2Resource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDestacado2s extends ListRecords
{
    protected static string $resource = Destacado2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
