<?php

namespace App\Filament\Resources\Destacados\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Table;
use App\Models\Inventario;
use Illuminate\Support\Facades\Log;

class DestacadosTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),
                ImageColumn::make('imgdestacada')
                    ->label('Destacada')
                    ->disk('public')
                    ->visibility('public')
                    ->square() // opcional: recorta cuadrado
                    ->size(80)
                    ->url(fn ($record) => asset('storage/' . $record->imgdestacada)) // link directo a la imagen
                    ->openUrlInNewTab(), // tamaño del
                ImageColumn::make('prod1')
                    ->label('Prod1')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->prod1);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->prod1);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
                ImageColumn::make('prod2')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->prod2);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->prod2);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
                ImageColumn::make('prod3')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->prod3);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->prod3);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
                ImageColumn::make('prod4')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->prod4);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->prod4);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
                ImageColumn::make('prod5')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->prod5);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->prod5);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
                ImageColumn::make('prod6')
                    ->disk('public')
                    ->visibility('public')
                    ->size(55)
                    ->getStateUsing(function ($record)  {
                        $producto = Inventario::find($record->prod6);
                        return $producto ? $producto->img1 : null;
                    })
                    ->url(function ($record)  {
                        $producto = Inventario::find($record->prod6);
                        return $producto ? asset('storage/' . $producto->img1) : null;
                    }) // link directo a la imagen
                    ->openUrlInNewTab(),
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
