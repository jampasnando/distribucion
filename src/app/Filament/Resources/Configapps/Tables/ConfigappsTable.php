<?php

namespace App\Filament\Resources\Configapps\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Columns\ImageColumn;

class ConfigappsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('whatsapp')
                    ->searchable(),
                TextColumn::make('nrocuenta')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('banco')
                    ->searchable()
                    ->wrap(),
                TextColumn::make('titularcuenta')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('facebook')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('tiktok')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('latitud')
                    ->searchable(),
                TextColumn::make('longitud')
                    ->searchable(),
                ImageColumn::make('logo')
                    ->label('Logo')
                    ->square(),
                TextColumn::make('horario')
                    ->wrap()
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
