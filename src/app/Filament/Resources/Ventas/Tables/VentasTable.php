<?php
namespace App\Filament\Resources\Ventas\Tables;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Filters\Filter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\Clientes\Pages\ViewCliente;

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
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
                Action::make('nota')
                    ->label('Nota')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn ($record) =>
                        $record
                            ? route('ventas.nota', ['venta' => $record->id])
                            : null
                    )
                    ->visible(fn ($record) => filled($record))
                    ->openUrlInNewTab()
            ])
            ->headerActions([

            ])
            ->defaultSort('fecha', 'desc');
    }
}
