<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Clientes\Widgets\KardexCliente;

class ViewCliente extends ViewRecord
{
    protected static string $resource = ClienteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
    protected function getFooterWidgets(): array
    {
        return [
            KardexCliente::make([
                'clienteId' => $this->record->id,
            ]),
        ];
    }
}
