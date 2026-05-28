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
        $pago = $this->record;
        $credito = $pago->credito;

        if (! $credito) {
            return;
        }

        $totalPagos = $credito->pagoscreditos()->sum('monto');

        if ($totalPagos >= $credito->saldo) {
            $credito->update([
                'estado' => 'cancelado',
            ]);
        }
    }
}
