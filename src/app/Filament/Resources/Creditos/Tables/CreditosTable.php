<?php

namespace App\Filament\Resources\Creditos\Tables;

use Dom\Text;
use Filament\Actions\Action;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CreditosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('venta_id')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('cliente.nombre')
                    ->sortable(),
                // TextColumn::make('venta.vendedor()->nombre')
                //     ->modifyStateUsing(function ($record) {
                //         return $record->venta ? $record->venta->vendedor_id : null;
                //     })
                //     ->label('Vendedor')
                //     ->sortable(),
                TextColumn::make('total')
                    ->label('Total Venta')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('saldo')
                    ->label('Saldo Inicial')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('saldo_restante')
                    ->label('Saldo Actual')
                    ->getStateUsing(function ($record) {
                        $pagos = $record->pagoscreditos()->sum('monto');
                        return $record->saldo - $pagos;
                    })
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fechainicio')
                    ->date()
                    ->tooltip(fn($state) => $state)
                    ->sortable(),
                TextColumn::make('fechavencimiento')
                    ->date()
                    ->color(fn ($record) =>
                        now()->greaterThan($record->fechavencimiento) && $record->saldo > 0
                            ? 'danger'
                            : null
                    )
                    ->tooltip(fn($state) => $state)
                    ->sortable(),
                TextColumn::make('estado')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('anticipo')
                    ->numeric()
                    ->sortable(),
            ])
            ->defaultSort('fechainicio', 'desc')
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                Action::make('nota')
                    ->label('Nota')
                    ->icon('heroicon-o-document-arrow-down')
                    ->url(fn ($record) =>
                        $record
                            ? route('ventas.nota', ['venta' => $record->venta_id])
                            : null
                    )
                    // ->visible(fn ($record) => filled($record))
                    ->openUrlInNewTab(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
