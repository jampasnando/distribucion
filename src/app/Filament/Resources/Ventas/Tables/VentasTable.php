<?php
namespace App\Filament\Resources\Ventas\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
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
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->defaultSort('fecha', 'desc');
    }
}
