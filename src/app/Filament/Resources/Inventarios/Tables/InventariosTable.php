<?php

namespace App\Filament\Resources\Inventarios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InventariosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('idprod')
                    ->searchable(),
                TextColumn::make('marca.nombre')
                    ->searchable(),
                TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('categoria')
                    ->searchable(),
                TextColumn::make('unidad')
                    ->searchable(),
                TextColumn::make('preciocompra')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('precioventa')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('comision')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('deposito')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('proveedor.nombre')
                    ->searchable(),
                TextColumn::make('img1')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
