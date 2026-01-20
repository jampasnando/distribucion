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
                ->columns(4)
                ->columnSpanFull(),

            Section::make('Productos')
                ->schema([
                    Repeater::make('inventarios')
                        ->relationship()
                        ->schema([
                            Select::make('inventario_id')
                                ->label('Producto')
                                ->options(fn () => Inventario::pluck('descripcion', 'id'))
                                ->searchable()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $set) {
                                    $producto = Inventario::find($state);
                                    if ($producto) {
                                        $set('precioventa', $producto->precioventa);
                                        $set('cantidad', 1);
                                        $set('subtotal', $producto->precioventa);
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
                                })
                                ->columnSpan(2),

                            TextInput::make('precioventa')
                                ->numeric()
                                ->required()
                                ->reactive()
                                ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                    $set('subtotal', ($get('cantidad') ?? 0) * $state);
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
                            Log::info('Updating total', ['state' => $state]);
                            $set('../../total', collect($state)->sum('subtotal'));
                        })
                        ->createItemButtonLabel('Agregar producto')
                        ->required(),
                ])
                ->columnSpanFull(),
        ]);
    }
}
