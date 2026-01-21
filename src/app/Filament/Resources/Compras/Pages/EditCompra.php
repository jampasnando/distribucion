<?php

namespace App\Filament\Resources\Compras\Pages;

use App\Filament\Resources\Compras\CompraResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCompra extends EditRecord
{
    protected static string $resource = CompraResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
    {
        $compra = $this->record;
        $data = $this->form->getState();

        $syncData = [];

        foreach ($data['inventarios'] as $item) {
            $syncData[$item['inventario_id']] = [
                'idprod' => $item['idprod'],
                'cantidad' => $item['cantidad'],
                'preciocompra' => $item['preciocompra'],
                'descripcion' => $item['descripcion'],
            ];
        }

        $compra->inventarios()->sync($syncData);
    }
}
