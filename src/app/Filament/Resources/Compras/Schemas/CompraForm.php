<?php

namespace App\Filament\Resources\Compras\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Illuminate\Support\Str;
use App\Models\Inventario;
use App\Models\Proveedor;;
use App\Models\Compra;

class CompraForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Datos de la compra')
                ->schema([
                TextInput::make('deposito_id')
                    ->hidden()
                    ->dehydrated()
                    ->default(1)
                    ->required()
                    ->numeric(),
                TextInput::make('idcompra')  // Campo oculto para idcompra
                        ->hidden()
                        ->default(function () {
                            do {
                                $code = Str::random(8);  // Genera un string alfanumérico de 8 caracteres
                            } while (Compra::where('idcompra', $code)->exists());  // Asegura unicidad
                            return $code;
                        })
                        ->dehydrated(),
                DateTimePicker::make('fecha')
                        ->default(now())
                        ->required(),
                Select::make('proveedor_id')  // Cambiar a Select
                        ->label('Proveedor')
                        ->options(fn () => Proveedor::pluck('nombre', 'id'))  // Asumiendo que el modelo Proveedor tiene 'id' y 'nombre'; ajusta si es diferente
                        ->searchable()
                        ->required(),
                TextInput::make('nit')
                        ->hidden(),
                Select::make('formapago')
                        ->options([
                            'efectivo' => 'Efectivo',
                            'qr' => 'QR',
                            'tarjeta' => 'Tarjeta',
                        ])
                        ->default('efectivo')
                        ->required(),
                TextInput::make('total')
                        ->numeric()
                        ->disabled()
                        ->dehydrated()
                        ->default(0),
                Textarea::make('comentario'),
                    // ->columnSpanFull(),
                TextInput::make('user_id')
                    ->hidden()
                    ->dehydrated()
                    ->default(fn () => auth()->user()->id)
                    ->required()
                    ->numeric(),
                TextInput::make('factura'),
            ])
            ->columns(4)
            ->columnSpanFull(),
            Section::make('Productos')
                ->schema([
                    Repeater::make('inventarios')
                        ->afterStateHydrated(function ($state, callable $set, $record) {
                            if ($record && $record->exists) {
                                $inventarios = $record->inventarios->map(function ($inventario) {
                                    return [
                                        'inventario_id' => $inventario->id,
                                        'idprod' => $inventario->pivot->idprod ?? $inventario->idprod,
                                        'preciocompra' => $inventario->pivot->preciocompra,
                                        'descripcion' => $inventario->pivot->descripcion,
                                        'cantidad' => $inventario->pivot->cantidad,
                                        'subtotal' => $inventario->pivot->cantidad * $inventario->pivot->preciocompra,
                                    ];
                                })->toArray();
                                $set('inventarios', $inventarios);  // Pobla el repeater con los datos existentes
                            }
                        })
                        ->schema([
                            Select::make('inventario_id')
                                ->label('Producto')
                                ->options(fn () => Inventario::pluck('descripcion', 'id'))
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    $producto = Inventario::find($state);
                                    if ($producto) {
                                        $set('idprod', $producto->idprod);
                                        $set('preciocompra', $producto->preciocompra);
                                        $set('descripcion', $producto->descripcion);
                                        $set('cantidad', 1);
                                        $set('subtotal', $producto->preciocompra);
                                        $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));
                                    }
                                })
                                ->columnSpan(6),

                            TextInput::make('cantidad')
                                ->numeric()
                                ->minValue(1)
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $set('subtotal', ($get('preciocompra') ?? 0) * $state);
                                    $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));
                                })
                                ->columnSpan(2),

                            TextInput::make('preciocompra')
                                 ->label('Precio Compra')
                                ->numeric()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $set('subtotal', ($get('cantidad') ?? 0) * $state);
                                    $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));
                                })
                                ->columnSpan(2),
                            TextInput::make('subtotal')
                                ->numeric()
                                ->disabled()
                                ->dehydrated()
                                ->columnSpan(2),
                        ])
                        ->columns(12)
                        ->afterStateUpdated(function ($state, callable $set) {
                            // Log::info('Updating total', ['state' => $state]);
                            $set('total', collect($state)->sum('subtotal'));
                        })
                        ->createItemButtonLabel('Agregar producto')
                        ->required(),
                ])
                ->columnSpanFull(),
        ]);
    }

}
