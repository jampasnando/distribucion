<?php
namespace App\Filament\Resources\VentaResource\Tables;

use Filament\Tables\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class VentaTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('fecha')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('cliente')
                    ->searchable(),

                TextColumn::make('total')
                    ->money('BOB')
                    ->sortable(),

                TextColumn::make('forma_pago')
                    ->badge(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->defaultSort('fecha', 'desc');
    }
}
