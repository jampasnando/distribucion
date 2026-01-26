<?php

namespace App\Filament\Resources\Creditos\Pages;

use App\Filament\Resources\Creditos\CreditoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCredito extends EditRecord
{
    protected static string $resource = CreditoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
