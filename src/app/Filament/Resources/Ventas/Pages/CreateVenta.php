<?php

namespace App\Filament\Resources\Ventas\Pages;

use App\Filament\Resources\Ventas\VentaResource;
use Filament\Resources\Pages\CreateRecord;
use App\Models\Credito;
use App\Models\Pagoscredito;

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
    protected function afterCreate(): void
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

        if(($data['formapago'] ?? '') === 'credito') {
            $anticipo = (float) ($data['anticipo'] ?? 0);
            $saldoInicial = $venta->total - $anticipo;

            // 1️⃣ Crear crédito
            $credito = Credito::create([
                'venta_id' => $venta->id,
                'cliente_id' => $venta->cliente_id,
                'total' => $venta->total,
                'saldo' => $saldoInicial,
                'fechainicio' => now(),
                'fechavencimiento' => $data['fechavencimiento'],
                'anticipo' => $anticipo,
                'detalle'=> $venta->detalle,
                'estado' => $saldoInicial > 0 ? 'activo' : 'cancelado',
            ]);

            // 2️⃣ Registrar anticipo como pago (si existe)
            if ($anticipo > 0) {
                Pagoscredito::create([
                    'credito_id' => $credito->id,
                    'monto' => $anticipo,
                    'fechapago' => now(),
                    'metodopago' => 'anticipo',
                    'comentarios' => 'Pago inicial al registrar la venta',
                ]);
            }

            // 3️⃣ Actualizar estado de la venta
            if ($saldoInicial <= 0) {
                // $venta->update(['estado' => 'pagada']);
            }
        }
    }
}
