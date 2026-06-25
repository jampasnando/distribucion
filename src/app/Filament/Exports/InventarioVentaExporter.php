<?php

namespace App\Filament\Exports;

use App\Models\InventarioVenta;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class InventarioVentaExporter extends Exporter
{
    protected static ?string $model = InventarioVenta::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('inventario_id'),
            ExportColumn::make('venta_id'),
            ExportColumn::make('venta.cliente.nombre')
                ->label('Cliente'),
            ExportColumn::make('idprod'),
            ExportColumn::make('precioventa'),
            ExportColumn::make('preciocompra'),
            ExportColumn::make('preciofinal'),
            ExportColumn::make('cantidad'),
            ExportColumn::make('descripcion'),
            ExportColumn::make('vendedor_id'),
            ExportColumn::make('vendedor.nombre')
                ->label('Vendedor'),
            ExportColumn::make('user.nombre')
                ->label('Usuario'),
            ExportColumn::make('comision'),
            ExportColumn::make('pagocomision'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('descuento'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Ventas exportadas con ' . Number::format($export->successful_rows) . ' ' . str('fila')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('fila')->plural($failedRowsCount) . ' falló al exportar.';
        }

        return $body;
    }
    public function getFileName(Export $export): string
    {
        return 'ventas_' . now()->format('dmY_His');
    }
}
