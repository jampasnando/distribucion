<?php

namespace App\Filament\Resources\Inventarios\Schemas;

use App\Models\Marca;
use App\Models\Proveedor;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class InventarioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('idprod'),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                Select::make('marca_id')  // Cambiar a Select
                        ->label('Marca')
                        ->options(fn () => Marca::pluck('nombre', 'id'))  // Asumiendo que el modelo Proveedor tiene 'id' y 'nombre'; ajusta si es diferente
                        ->searchable()
                        ->required(),
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
                TextInput::make('deposito')
                    ->default(1)
                    ->visible(false),
                Select::make('proveedor_id')  // Cambiar a Select
                        ->label('Proveedor')
                        ->options(fn () => Proveedor::pluck('nombre', 'id'))  // Asumiendo que el modelo Proveedor tiene 'id' y 'nombre'; ajusta si es diferente
                        ->searchable()
                        ->required(),
                Textarea::make('imagenes')
                    ->visible(false),
                TextInput::make('img1'),
                TextInput::make('img2')
                ->visible(false),
                TextInput::make('img3')
                ->visible(false),
            ])
            ->columns(5);
    }
}
