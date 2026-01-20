<?php

namespace App\Filament\Resources\Inventarios\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Actions\CreateAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;

class InventariosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('idprod')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(30)
                    ->searchable()
                    ->tooltip(fn ($record) => $record->descripcion),
                TextColumn::make('marca')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable()
                    ->label('Cant'),
                TextColumn::make('categoria')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('unidad')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('preciocompra')
                    ->numeric()
                    ->visible(fn () => auth()->user()->role === 'administrador')
                    ->sortable()
                    ->visible(fn()=>auth()->user()->role == 'administrador')
                    ->label('PComp'),
                TextColumn::make('precioventa')
                    ->numeric()
                    ->sortable()
                    ->visible(fn()=>auth()->user()->role == 'administrador')
                    ->label('PVenta'),
                TextColumn::make('comision')
                    ->numeric()
                    ->visible(fn () => auth()->user()->role === 'administrador')
                    ->sortable(),
                TextColumn::make('deposito')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('proveedor')
                    ->searchable()
                    ->visible(fn()=>auth()->user()->role == 'administrador')
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('img1')
                    ->imagesize('50px', '50px')
                    ->visibility('public')
                    ->disk('public')
                    ->tooltip(fn ($record) => $record->img1),
                TextColumn::make('img2')
                    ->limit(10)
                    ->tooltip(fn ($record) => $record->img2),
                TextColumn::make('img3')
                    ->limit(10)
                    ->tooltip(fn ($record) => $record->img3),
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
                    DeleteBulkAction::make()
                    ->disabled(fn () => auth()->user()->role !== 'administrador'),
                ]),
                
            ]);
            
    }
}
