<?php

namespace App\Filament\Resources\Inventarios\Tables;

use App\Filament\Exports\InventarioExporter;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Actions\ViewAction;
use Filament\Exports\ExportColumn;
use Filament\Exports\Exporter;
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
                    ->label('Marca')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('descripcion')
                    ->searchable()
                    ->limit(25)
                    ->tooltip(fn($state) => $state),
                TextColumn::make('cantidad')
                    ->label('Cant')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('categoria')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('unidad')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('preciocompra')
                    ->visible(fn()=>auth()->user()->hasRole('Administrador'))
                    ->label('Pcompra')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('precioventa')
                    ->label('Pventa')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('oferta')
                    ->badge()
                    ->label('Oferta')
                    ->getStateUsing(fn ($record) =>
                        $record?->ofertas?->isNotEmpty() ? 'EN OFERTA' : null
                    )
                    ->colors([
                        'danger' => 'EN OFERTA',
                    ])
                    ->tooltip(function($record){
                        return $record?->ofertas?->isNotEmpty() ? $record->ofertas->first()->precio_oferta : null;
                    }),
                    // ->visible(fn ($record) =>
                    //     $record?->ofertas?->isNotEmpty()
                    // ),

                TextColumn::make('comision')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('deposito')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('proveedor.nombre')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ])
            ->headerActions([
                ExportAction::make()
                    ->exporter(InventarioExporter::class),
            ]);
    }
}
