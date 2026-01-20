<?php
namespace App\Filament\Resources\VentaResource\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Repeater;
use Filament\Schemas\Components\Select;
use Filament\Schemas\Components\TextInput;
use Filament\Schemas\Components\DateTimePicker;
use App\Models\Inventario;

class VentaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Datos de la venta')
                ->schema([
                    DateTimePicker::make('fecha')
                        ->default(now())
                        ->required(),

                    TextInput::make('cliente')
                        ->required()
                        ->maxLength(255),

                    Select::make('forma_pago')
                        ->options([
                            'efectivo' => 'Efectivo',
                            'qr' => 'QR',
                            'tarjeta' => 'Tarjeta',
                        ])
                        ->required(),

                    TextInput::make('total')
                        ->numeric()
                        ->disabled()
                        ->dehydrated()
                        ->default(0),
                ])
                ->columns(4),

            Section::make('Productos')
                ->schema([
                    Repeater::make('inventarios')
                        ->relationship()
                        ->schema([
                            Select::make('inventario_id')
                                ->label('Producto')
                                ->options(fn () => Inventario::pluck('nombre', 'id'))
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $producto = Inventario::find($state);
                                    if ($producto) {
                                        $set('precio_unitario', $producto->precio);
                                    }
                                }),

                            TextInput::make('cantidad')
                                ->numeric()
                                ->minValue(1)
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $set('subtotal', ($get('precio_unitario') ?? 0) * $state);
                                }),

                            TextInput::make('precio_unitario')
                                ->numeric()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $set('subtotal', ($get('cantidad') ?? 0) * $state);
                                }),

                            TextInput::make('subtotal')
                                ->numeric()
                                ->disabled()
                                ->dehydrated(),
                        ])
                        ->columns(4)
                        ->afterStateUpdated(function ($state, callable $set) {
                            $set('../../total', collect($state)->sum('subtotal'));
                        })
                        ->createItemButtonLabel('Agregar producto')
                        ->required(),
                ]),
        ]);
    }
}
