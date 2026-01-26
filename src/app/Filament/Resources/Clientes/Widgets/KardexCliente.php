<?php
namespace App\Filament\Resources\Clientes\Widgets;

use Filament\Widgets\TableWidget;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Venta;
use Illuminate\Support\Facades\Log;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;

class KardexCliente extends TableWidget
{
    protected static ?string $heading = 'Kárdex del cliente';

    public int $clienteId;

    public function mount(int $clienteId): void
    {
        $this->clienteId = $clienteId;
    }

    /** ✅ AQUÍ VA LA QUERY */
    protected function getTableQuery(): Builder
    {
        $query = Venta::query()
            ->where('cliente_id', $this->clienteId)
            ->with('credito')
            ->orderBy('fecha','desc');
        return $query;
    }

    /** ✅ AQUÍ VAN LAS COLUMNAS */
    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('created_at')
                ->label('Fecha')
                ->date('d/m/Y'),

            TextColumn::make('id')
                ->label('Venta #'),

            TextColumn::make('formapago')
                ->badge()
                ->colors([
                    'success' => 'contado',
                    'warning' => 'credito',
                ]),

            TextColumn::make('total')
                ->money('BOB'),

            TextColumn::make('credito.saldo')
                ->label('Saldo')
                ->money('BOB')
                ->default('0.00'),
        ];
    }

    /** (opcional) */
    protected function getTableActions(): array
    {
        return [
            Action::make('ver')
                ->icon('heroicon-o-eye')
                ->url(fn ($record) =>
                    \App\Filament\Resources\Ventas\VentaResource::getUrl(
                        'view',
                        ['record' => $record->id]
                    )
                ),
        ];
    }
}
