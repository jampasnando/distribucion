<?php

namespace App\Filament\Resources\Clientes\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use Filament\Support\Enums\Alignment;
use Filament\Support\Icons\Heroicon;

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
                IconColumn::make('latitud')
                    ->label('Ubicación')
                    ->icon('heroicon-o-map-pin')
                    ->color('info')
                    ->alignCenter()
                    ->action(
                        Action::make('ver_mapa')
                            ->label('Ubicación')
                            ->icon('heroicon-o-map-pin')
                            ->color('info')
                            ->modalHeading('Ubicación del cliente')
                            ->modalWidth('xl')
                            ->modalAlignment(Alignment::Center)
                            ->modalContent(fn ($record) => view(
                                'filament.modals.mapa-cliente',
                                [
                                    'lat' => $record->latitud,
                                    'lng' => $record->longitud,
                                    'cliente' => $record->nombre,
                                ]
                            ))
                            ->visible(fn ($record) => $record->latitud && $record->longitud),
                    ),
                TextColumn::make('ciudad')
                    ->searchable(),
                TextColumn::make('ruta')
                    ->searchable(),
                TextColumn::make('circuito')
                    ->searchable(),
                // TextColumn::make('banco')
                //     ->searchable(),
                // TextColumn::make('nrocuenta')
                //     ->searchable(),
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
                ViewAction::make()
                ->label('Kardex'),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
