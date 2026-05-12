<?php

namespace App\Filament\Resources\Creditos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CreditoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Datos de la venta')
                ->schema([
                    TextInput::make('venta_id')
                        ->numeric(),

                    TextInput::make('cliente_id')
                        ->numeric(),

                    TextInput::make('total')
                        ->numeric(),

                    TextInput::make('saldo')
                        ->numeric(),

                    DateTimePicker::make('fechainicio'),

                    DateTimePicker::make('fechavencimiento'),

                    TextInput::make('estado'),

                    TextInput::make('anticipo')
                        ->numeric(),

                    Textarea::make('detalles')
                        ->columnSpanFull(),
                ])
                ->collapsible()
                ->collapsed()
            ]);
    }
}
