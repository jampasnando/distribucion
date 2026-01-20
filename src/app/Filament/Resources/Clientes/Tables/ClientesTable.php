<?php

namespace App\Filament\Resources\Clientes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ClientesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('nombre')
                    ->searchable(),
                TextColumn::make('ci')
                    ->searchable(),
                TextColumn::make('nit')
                    ->searchable(),
                TextColumn::make('telefono')
                    ->searchable(),
                TextColumn::make('celular')
                    ->searchable(),
                TextColumn::make('latitud')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('longitud')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('ciudad')
                    ->searchable(),
                TextColumn::make('ruta')
                    ->searchable(),
                TextColumn::make('circuito')
                    ->searchable(),
                TextColumn::make('banco')
                    ->searchable(),
                TextColumn::make('nrocuenta')
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
