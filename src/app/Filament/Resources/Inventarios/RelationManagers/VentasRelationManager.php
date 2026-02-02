<?php

namespace App\Filament\Resources\Inventarios\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class VentasRelationManager extends RelationManager
{
    protected static string $relationship = 'ventas';
    protected static ?string $title = 'Kardex';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('fecha')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->defaultSort('inventario_venta.created_at', 'desc')
            ->columns([
                TextColumn::make('created_at')
                    ->label('Fecha')
                    ->dateTime('d/m/Y H:i'),

                TextColumn::make('id')
                    ->label('Venta')
                    ->sortable(),

                TextColumn::make('cliente.nombre')
                    ->label('Cliente')
                    ->searchable(),

                TextColumn::make('cantidad')
                    ->label('Cantidad')
                    ->state(fn ($record) => $record->pivot->cantidad),

                TextColumn::make('pivot.precioventa')
                    ->label('P. Venta')
                    ->money('BOB'),

                TextColumn::make('pivot.descuento')
                    ->label('Desc.')
                    ->money('BOB'),

                TextColumn::make('pivot.preciofinal')
                    ->label('P. Final')
                    ->money('BOB'),

                TextColumn::make('pivot.comision')
                    ->label('Comisión')
                    ->money('BOB'),

                TextColumn::make('total')
                    ->label('Total')
                    ->state(fn ($record) =>
                        $record->pivot->cantidad * $record->pivot->preciofinal
                    )
                    ->money('BOB'),
            ]);
    }
}
