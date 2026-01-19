<?php

namespace App\Filament\Resources\Destacado2s\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Models\Inventario;
use Illuminate\Support\Facades\Log;
use Filament\Tables\Columns\ImageColumn;

class Destacado2sTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulox')
                    ->searchable(),
                ImageColumn::make('imgx1')
                    ->label('Prodx1')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->imgx1);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->imgx1);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
                ImageColumn::make('imgx2')
                    ->label('Prodx2')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->imgx2);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->imgx2);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
                TextColumn::make('imgx3')
                    ->searchable(),
                TextColumn::make('imgx4')
                    ->searchable(),
                TextColumn::make('tituloy')
                    ->searchable(),
                TextColumn::make('imgy1')
                    ->searchable(),
                TextColumn::make('imgy2')
                    ->searchable(),
                TextColumn::make('imgy3')
                    ->searchable(),
                TextColumn::make('imgy4')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                IconColumn::make('estado')
                    ->boolean(),
                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),
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
