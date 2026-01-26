<?php

namespace App\Filament\Resources\Creditos\Pages;

use App\Filament\Resources\Creditos\CreditoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCreditos extends ListRecords
{
    protected static string $resource = CreditoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
