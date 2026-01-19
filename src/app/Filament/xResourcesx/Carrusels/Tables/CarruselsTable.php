<?php

namespace App\Filament\Resources\Carrusels\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;

class CarruselsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('imagen')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('imagen')
                    ->label('Vista previa')
                    ->disk('public')
                    ->visibility('public')
                    ->square() // opcional: recorta cuadrado
                    ->size(80)
                    ->url(fn ($record) => asset('storage/' . $record->imagen)) // link directo a la imagen
                    ->openUrlInNewTab(), // tamaño del thumbnail en px
            ])
            ->reorderable('orden') // ← aquí se activa el drag & drop
            ->defaultSort('orden') // orden inicial según el campo
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
