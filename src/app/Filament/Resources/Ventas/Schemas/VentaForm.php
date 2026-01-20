<?php
namespace App\Filament\Resources\Ventas\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use App\Models\Inventario;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Log;
use App\Models\Cliente;
use App\Models\Venta;
use Illuminate\Support\Str;

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

                    Select::make('cliente_id')  // Cambiar a Select
                        ->label('Cliente')
                        ->options(fn () => Cliente::pluck('nombre', 'id'))  // Asumiendo que el modelo Cliente tiene 'id' y 'nombre'; ajusta si es diferente
                        ->searchable()
                        ->required(),

                    Select::make('formapago')
                        ->options([
                            'efectivo' => 'Efectivo',
                            'qr' => 'QR',
                            'tarjeta' => 'Tarjeta',
                        ])
                        ->default('efectivo')
                        ->required(),
                    TextInput::make('deposito_id')  // Campo oculto para deposito_id
                        ->hidden()
                        ->default(1)
                        ->dehydrated(),
                    TextInput::make('idventa')  // Campo oculto para idventa
                        ->hidden()
                        ->default(function () {
                            do {
                                $code = Str::random(8);  // Genera un string alfanumérico de 8 caracteres
                            } while (Venta::where('idventa', $code)->exists());  // Asegura unicidad
                            return $code;
                        })
                        ->dehydrated(),
                    TextInput::make('total')
                        ->numeric()
                        ->disabled()
                        ->dehydrated()
                        ->default(0),
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
                                        'precioventa' => $inventario->pivot->precioventa,
                                        'preciocompra' => $inventario->pivot->preciocompra,
                                        'preciofinal' => $inventario->pivot->preciofinal,
                                        'comision' => $inventario->pivot->comision,
                                        'vendedor_id' => $inventario->pivot->vendedor_id,
                                        'pagocomision' => $inventario->pivot->pagocomision,
                                        'descripcion' => $inventario->pivot->descripcion,
                                        'cantidad' => $inventario->pivot->cantidad,
                                        'subtotal' => $inventario->pivot->cantidad * $inventario->pivot->precioventa,
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
                                        $set('precioventa', $producto->precioventa);
                                        $set('preciocompra', $producto->preciocompra);
                                        $set('preciofinal', $producto->precioventa);
                                        $set('comision', $producto->comision);
                                        $set('vendedor_id', auth()->user()->id);
                                        $set('pagocomision', NULL);
                                        $set('descripcion', $producto->descripcion);
                                        $set('cantidad', 1);
                                        $set('subtotal', $producto->precioventa);
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
                                    $set('subtotal', ($get('precioventa') ?? 0) * $state);
                                    $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));
                                })
                                ->columnSpan(2),

                            TextInput::make('precioventa')
                                ->numeric()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $set('subtotal', ($get('cantidad') ?? 0) * $state);
                                    $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));
                                })
                                ->columnSpan(2),
                            // TextInput::make('preciocompra')
                            //     ->hidden()
                            //     ->numeric()
                            //     ->dehydrated(),
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
