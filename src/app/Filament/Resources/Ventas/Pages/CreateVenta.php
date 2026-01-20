<?php

namespace App\Filament\Resources\Ventas\Pages;

use App\Filament\Resources\Ventas\VentaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVenta extends CreateRecord
{
    protected static string $resource = VentaResource::class;
    // protected function getRedirectUrl(): string
    // {
    //     return $this->getResource()::getUrl('index');
    // }
    // protected function mutateFormDataBeforeCreate(array $data): array
    // {
    //     // Generar un código único para la venta
    //     $data['codigo'] = 'VENTA-' . Str::upper(Str::random(8));
        
    //     return $data;
    // }
    protected function afterSave(): void
    {
        $venta = $this->record;  // La venta recién creada
        $data = $this->form->getState();  // Obtén los datos del formulario

        foreach ($data['inventarios'] as $item) {
            $venta->inventarios()->attach($item['inventario_id'], [
                'idprod' => $item['idprod'],
                'cantidad' => $item['cantidad'],
                'precioventa' => $item['precioventa'],
                'preciocompra' => $item['preciocompra'],
                'preciofinal' => $item['preciofinal'],
                'comision' => $item['comision'],
                'vendedor_id' => $item['vendedor_id'],
                'pagocomision' => $item['pagocomision'],
                'descripcion' => $item['descripcion'],
                // Agrega otros campos del pivot si es necesario, como 'preciocompra', etc.
            ]);
        }
    }
}
