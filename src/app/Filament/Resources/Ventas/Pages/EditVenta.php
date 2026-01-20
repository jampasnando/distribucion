<?php

namespace App\Filament\Resources\Ventas\Pages;

use App\Filament\Resources\Ventas\VentaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditVenta extends EditRecord
{
    protected static string $resource = VentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
    protected function afterSave(): void
    {
        $venta = $this->record;
        $data = $this->form->getState();

        $syncData = [];

        foreach ($data['inventarios'] as $item) {
            $syncData[$item['inventario_id']] = [
                'idprod' => $item['idprod'],
                'cantidad' => $item['cantidad'],
                'precioventa' => $item['precioventa'],
                'preciocompra' => $item['preciocompra'],
                'preciofinal' => $item['preciofinal'],
                'comision' => $item['comision'],
                'vendedor_id' => $item['vendedor_id'],
                'pagocomision' => $item['pagocomision'],
                'descripcion' => $item['descripcion'],
            ];
        }

        $venta->inventarios()->sync($syncData);
    }

}
