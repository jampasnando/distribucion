<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Actions\Action;

class ClienteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('ci')
                    ->required(),
                TextInput::make('nit'),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('celular'),
                TextInput::make('ciudad'),
                Section::make('Ubicación')
                    ->schema([
                        TextInput::make('latitud')
                            ->numeric()
                            ->reactive(),

                        TextInput::make('longitud')
                            ->numeric()
                            ->reactive(),
                    ])
                    ->columns(2)
                    ->headerActions([
                        Action::make('seleccionarMapa')
                            ->label('Seleccionar en mapa')
                            ->icon('heroicon-o-map-pin')
                            ->modalHeading('Seleccionar ubicación')
                            ->modalWidth('7xl')
                            ->modalSubmitAction(false) // ❌ quita Enviar
                            ->modalCancelAction(false)
                            ->modalContent(fn ($livewire) => view(
                                'filament.modals.selector-mapa',
                                [
                                    'lat' => $livewire->data['latitud'] ?? null,
                                    'lng' => $livewire->data['longitud'] ?? null,
                                ]
                            )),
                        ])
                        ->columnSpan(2),
                Textarea::make('direccion')
                    ->columnSpanFull(),
                TextInput::make('ruta'),
                TextInput::make('circuito'),
                // TextInput::make('banco'),
                // TextInput::make('nrocuenta'),
            ])
            ->columns(4);
    }
}
