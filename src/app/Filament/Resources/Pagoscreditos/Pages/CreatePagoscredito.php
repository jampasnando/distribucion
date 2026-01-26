<?php

namespace App\Filament\Resources\Pagoscreditos\Pages;

use App\Filament\Resources\Pagoscreditos\PagoscreditoResource;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreatePagoscredito extends CreateRecord
{
    protected static string $resource = PagoscreditoResource::class;
    public ?int $creditoId = null;
    public function mount(): void
    {
        parent::mount();

        $this->creditoId = request()->query('credito_id');
    }
    protected function afterCreate(): void
    {
        $pago = $this->record; // El pago recién creado
        $credito = $pago->credito; // Relación Eloquent con Credito

        // Suma total de pagos
        $totalPagos = $credito->pagos()->sum('monto');

        // Si los pagos cubren o superan el total del crédito
        if ($totalPagos >= $credito->total) {
            $credito->update([
                'estado' => 'cancelado',
            ]);
        }
    }
}
