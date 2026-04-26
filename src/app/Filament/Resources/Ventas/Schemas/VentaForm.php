<?php
namespace App\Filament\Resources\Ventas\Schemas;

use App\Models\Cliente;
use App\Models\Inventario;
use App\Models\User;
use App\Models\Venta;
use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class VentaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->schema([
            Section::make('Datos de la venta')
                ->afterStateHydrated(function ($state, callable $set, $record) {
                        // Log::info('Hydrating credit section', ['record' => $record->credito]);
                        // Log::info('Hydrating credit section', ['record' => $record->credito->fechavencimiento]);
                        // Log::info('Hydrating fechavencimiento Carbon section', ['record' => Carbon::parse($record->credito->fechavencimiento)]);
                        if ($record && $record->credito && $record->exists) {
                            $set('fechavencimiento', Carbon::parse($record->credito->fechavencimiento));
                            $set('saldo', $record->credito->saldo);
                            $set('total', $record->credito->total);
                            $set('anticipo', $record->credito->total - $record->credito->saldo);
                            $set('detalles', $record->credito->detalles);
                        }
                    })
                ->schema([
                    Hidden::make('user_id')
                        ->default(fn()=>auth()->user()->id),
                    DateTimePicker::make('fecha')
                        ->default(now())
                        ->native(false)
                        ->displayFormat('d-m-Y')
                        ->required(),
                    Select::make('vendedor_id')
                        ->label('Vendedor')
                        ->options(fn() => User::pluck('name','id'))
                        ->default(fn() => auth()->user()->id),
                    Select::make('cliente_id')  // Cambiar a Select
                        ->label('Cliente')
                        ->options(fn () => Cliente::pluck('nombre', 'id'))  // Asumiendo que el modelo Cliente tiene 'id' y 'nombre'; ajusta si es diferente
                        ->searchable()
                        ->required(),

                    Select::make('formapago')
                        ->options([
                            'contado' => 'Contado',
                            // 'qr' => 'QR',
                            // 'tarjeta' => 'Tarjeta',
                            'credito' => 'Crédito',
                        ])
                        ->default('contado')
                        ->reactive()
                        ->required(),
                    Hidden::make('deposito_id')  // Campo oculto para deposito_id
                        ->default(1),
                    Hidden::make('idventa')  // Campo oculto para idventa
                        ->default(function () {
                            do {
                                $code = Str::random(8);  // Genera un string alfanumérico de 8 caracteres
                            } while (Venta::where('idventa', $code)->exists());  // Asegura unicidad
                            return $code;
                        }),
                    TextInput::make('total')
                        ->numeric()
                        ->disabled()
                        ->dehydrated()
                        ->default(0),
                ])
                ->columns(5)
                ->columnSpanFull(),
            Section::make('Crédito')
                ->description('')
                ->visible(fn (callable $get) => $get('formapago') === 'credito')
                ->schema([
                    DatePicker::make('fechavencimiento')
                        ->label('Fecha de vencimiento')
                        // ->required()
                        ->minDate(now()->addDay())
                        ->reactive(),
                        // ->extraAttributes(['style' => 'background:lightyellow;text-color:black;']),
                    TextInput::make('anticipo')
                        ->label('Anticipo')
                        ->numeric()
                        ->default(0)
                        ->minValue(0)
                        ->reactive(),
                        // ->extraAttributes(['style' => 'background:lightyellow;']),
                    Textarea::make('detalles')
                        ->columnSpan(2)
                        ->reactive(),
                        // ->extraAttributes(['style' => 'background:whitegoldenrod;']),
                ])
                ->columns(4)
                ->extraAttributes(['style' => 'background:lightyellow;padding:10px;border-radius:10px;'])
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
                                        'descuento' => $inventario->pivot->descuento,
                                        'subtotal' => $inventario->pivot->cantidad * $inventario->pivot->preciofinal,
                                    ];
                                })->toArray();
                                $set('inventarios', $inventarios);  // Pobla el repeater con los datos existentes
                            }
                        })
                        ->schema([
                            Select::make('inventario_id')
                                ->label('Producto')
                                ->getSearchResultsUsing(function (string $search) {
                                    return Inventario::query()
                                        ->where(function ($q) use ($search) {
                                            $q->where('descripcion', 'like', "%{$search}%")
                                            ->orWhere('idprod', 'like', "%{$search}%");
                                        })
                                        ->limit(20)
                                        ->get()
                                        ->mapWithKeys(fn ($i) => [
                                            $i->id => "{$i->idprod} — {$i->descripcion}"
                                        ]);
                                })
                                ->getOptionLabelUsing(fn ($value) =>
                                    optional(Inventario::find($value))->idprod
                                        . ' — ' .
                                    optional(Inventario::find($value))->descripcion
                                )
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set, callable $get) {
                                    $producto = Inventario::find($state);
                                    if ($producto) {
                                        $set('idprod', $producto->idprod);
                                        $set('precioventa', $producto->precioventa);
                                        $set('preciocompra', $producto->preciocompra);
                                        $precio = $producto->ofertaActiva
                                            ? $producto->ofertaActiva->precio_oferta
                                            : $producto->precioventa;
                                        // $set('preciofinal', $producto->precioventa);
                                        $set('preciofinal', $precio);
                                        $set('comision', $producto->comision);
                                        $set('vendedor_id', auth()->user()->id);
                                        $set('pagocomision', NULL);
                                        $set('descripcion', $producto->descripcion);
                                        $set('stock', $producto->cantidad);
                                        $set('cantidad', 1);
                                        $set('subtotal', $producto->precioventa);
                                        $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));
                                    }
                                })
                                ->columnSpan(5),
                            TextInput::make('stock')
                                ->label('Stock')
                                ->disabled()
                                ->dehydrated(false),
                            TextInput::make('cantidad')
                                ->numeric()
                                ->minValue(1)
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set,$record) {
                                    $set('subtotal', ($get('preciofinal') ?? 0) * $state);
                                    $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));

                                }),

                            TextInput::make('preciofinal')
                                 ->label('Precio')
                                ->numeric()
                                ->disabled()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $set('subtotal', ($get('cantidad') ?? 0) * $state);
                                    $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));

                                })
                                ->dehydrated()
                                // ->extraAttributes(function($record){
                                //     if($record){
                                //         $producto = Inventario::find($record->id);
                                //         Log::info('prducto: ',['producto' => $producto]);
                                //         if($producto){
                                //             return ['style'=>'background:lightyellow;'];
                                //         }
                                //         return [];
                                //     }
                                //     return [];
                                // })
                                ->columnSpan(2),
                            TextInput::make('descuento')
                                ->label('Desc. %')
                                ->numeric()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $precioFinal = $get('precioventa') - $get('precioventa') * $state / 100;
                                    $set('preciofinal', $precioFinal);
                                    $set('subtotal', ($get('cantidad') ?? 0) * $precioFinal);
                                    $inventarios = $get('../../inventarios');
                                        $set('../../total', collect($inventarios)->sum(fn ($item) => $item['subtotal'] ?? 0));
                                })
                                ->default(0)
                                ->dehydrated(),
                            TextInput::make('subtotal')
                                ->numeric()
                                ->disabled()
                                ->dehydrated()
                                ->default(0)
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
