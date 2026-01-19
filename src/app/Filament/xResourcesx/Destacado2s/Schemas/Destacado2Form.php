<?php

namespace App\Filament\Resources\Destacado2s\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use App\Models\Inventario;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\ColorPicker;

class Destacado2Form
{
    public static function configure(Schema $schema): Schema
    {
        $productos = Inventario::all()->mapWithKeys(function ($p) {
            return [
                $p->id => "{$p->descripcion} - Bs. {$p->precioventa} - Stock: {$p->cantidad}"
            ];
        })->toArray();
        return $schema
    ->components([
        // Primera sección (titulox + imgx1..imgx4)xy
        ColorPicker::make('color')
            ->label('Color de fondox')
            ->columnSpanFull(),
        Section::make('Sección X')
            ->schema([
                TextInput::make('titulox'),
                
                Grid::make(2) // 4 columnas para que las imágenes vayan en una sola fila
                    ->schema([
                        Select::make('imgx1')->label('Producto 1')->options($productos)->searchable()
                        ->preload(),
                        Select::make('imgx2')->label('Producto 2')->options($productos)->searchable()
                        ->preload(),
                        Select::make('imgx3')->label('Producto 3')->options($productos)->searchable()
                        ->preload(),
                        Select::make('imgx4')->label('Producto 4')->options($productos)->searchable()
                        ->preload(),
                    ]),
            ]),

        // Segunda sección (tituloy + imgy1..imgy4)
        Section::make('Sección Y')
            ->schema([
                TextInput::make('tituloy')
                    ->columnSpanFull(),

                Grid::make(2) // 4 columnas para que las imágenes vayan en una sola fila
                    ->schema([
                        Select::make('imgy1')->label('Producto 5')->options($productos)->searchable()
                        ->preload(),
                        Select::make('imgy2')->label('Producto 6')->options($productos)->searchable()
                        ->preload(),
                        Select::make('imgy3')->label('Producto 7')->options($productos)->searchable()
                        ->preload(),
                        Select::make('imgy4')->label('Producto 8')->options($productos)->searchable()
                        ->preload(),
                    ]),
            ]),

        // Otros campos
        Toggle::make('estado'),
        TextInput::make('orden')
            ->numeric()
            ->default(0),
    ]);

    }
}
