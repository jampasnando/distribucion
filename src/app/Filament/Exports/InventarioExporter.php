<?php

namespace App\Filament\Exports;

use App\Models\Inventario;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Number;

class InventarioExporter extends Exporter
{
    protected static ?string $model = Inventario::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID'),
            ExportColumn::make('idprod'),
            ExportColumn::make('descripcion'),
            ExportColumn::make('marca_id'),
            ExportColumn::make('cantidad'),
            ExportColumn::make('categoria'),
            ExportColumn::make('unidad'),
            ExportColumn::make('preciocompra'),
            ExportColumn::make('precioventa'),
            ExportColumn::make('comision'),
            ExportColumn::make('deposito'),
            ExportColumn::make('proveedor_id'),
            // ExportColumn::make('imagenes'),
            // ExportColumn::make('img1'),
            // ExportColumn::make('img2'),
            // ExportColumn::make('img3'),
            ExportColumn::make('updated_at'),
            ExportColumn::make('created_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your inventario export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
