<?php
namespace App\Filament\Resources\Ventas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables;
use App\Filament\Resources\Clientes\Pages\ViewCliente;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;

class VentasTable
{
    
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('cliente.nombre')
                    ->searchable()
                    ->sortable()
                    ->url(fn ($record) => ViewCliente::getUrl(
                        // la página ViewCliente espera el registro del cliente
                        ['record' => $record->cliente_id]
                    )),

                TextColumn::make('total')
                    ->money('BOB')
                    ->sortable(),

                BadgeColumn::make('formapago')
                    ->colors([
                        'info' => 'credito',
                        'warning' => 'contado',
                    ]),
            ])
            // ->filters([
            //     SelectFilter::make('formapago')
            //         ->label('Tipo de venta')
            //         ->options([
            //             'contado' => 'Al contado',
            //             'credito' => 'A crédito',
            //         ])
            //         // ->placeholder('Todas'), // Por defecto muestra todas
            //         ->query(function ($query, $value) {
            //             $query->when($value, fn($q) => $q->where('formapago', $value));
            //         }),

            //     Filter::make('fecha')
            //         ->label('Rango de fechas')
            //         ->form([
            //             \Filament\Forms\Components\DatePicker::make('start')->label('Desde'),
            //             \Filament\Forms\Components\DatePicker::make('end')->label('Hasta'),
            //         ])
            //         ->query(function ($query, array $data) {
            //             if (!empty($data['start'])) {
            //                 $query->whereDate('created_at', '>=', $data['start']);
            //             }
            //             if (!empty($data['end'])) {
            //                 $query->whereDate('created_at', '<=', $data['end']);
            //             }
            //         }),
            // ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->defaultSort('fecha', 'desc');
    }
}
