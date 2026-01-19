<?php

namespace App\Filament\Resources\Configapps\Pages;

use App\Filament\Resources\Configapps\ConfigappResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListConfigapps extends ListRecords
{
    protected static string $resource = ConfigappResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
