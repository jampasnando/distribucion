<?php

namespace App\Filament\Resources\Inventarios\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class InventarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('idprod'),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                TextInput::make('marca'),
                TextInput::make('cantidad')
                    ->numeric()
                    ->default(0),
                TextInput::make('categoria'),
                TextInput::make('unidad'),
                TextInput::make('preciocompra')
                    ->numeric()
                    ->default(0),
                TextInput::make('precioventa')
                    ->numeric()
                    ->default(0),
                TextInput::make('comision')
                    ->numeric()
                    ->default(0),
                TextInput::make('deposito'),
                TextInput::make('proveedor'),
                Textarea::make('imagenes')
                    ->columnSpanFull(),
                TextInput::make('img1'),
                TextInput::make('img2'),
                TextInput::make('img3'),
            ]);
    }
}
