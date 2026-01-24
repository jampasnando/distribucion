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

        // if(($data['formapago'] ?? '') === 'credito') {
        //     $anticipo = (float) ($data['anticipo'] ?? 0);
        //     $saldoInicial = $venta->total - $anticipo;

        //     // 1️⃣ Crear crédito
        //     $credito = Credito::create([
        //         'venta_id' => $venta->id,
        //         'cliente_id' => $venta->cliente_id,
        //         'total' => $venta->total,
        //         'saldo' => $saldoInicial,
        //         'fechainicio' => now(),
        //         'fechavencimiento' => $data['fechavencimiento'],
        //         'estado' => $saldoInicial > 0 ? 'activo' : 'cancelado',
        //     ]);
        // }
    }

}
