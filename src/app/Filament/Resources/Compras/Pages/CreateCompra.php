<?php

namespace App\Filament\Resources\Compras\Pages;

use App\Filament\Resources\Compras\CompraResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Inventario;

class CreateCompra extends CreateRecord
{
    protected static string $resource = CompraResource::class;
    protected function afterCreate(): void
    {
        $compra = $this->record;  // La compra recién creada
        $data = $this->form->getState();  // Obtén los datos del formulario

        foreach ($data['inventarios'] as $item) {
            $compra->inventarios()->attach($item['inventario_id'], [
                'idprod' => $item['idprod'],
                'cantidad' => $item['cantidad'],
                'preciocompra' => $item['preciocompra'],
                'descripcion' => $item['descripcion'],
            ]);

            // Actualizar el inventario: aumentar cantidad y actualizar preciocompra
            $inventario = Inventario::find($item['inventario_id']);
            if ($inventario) {
                $inventario->increment('cantidad', $item['cantidad']);
                $inventario->update(['preciocompra' => $item['preciocompra']]);
            }
        }
    }
}
