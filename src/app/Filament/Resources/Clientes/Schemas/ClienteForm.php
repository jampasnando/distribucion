<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

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
                TextInput::make('nit')
                    ->required(),
                TextInput::make('telefono')
                    ->tel()
                    ->required(),
                TextInput::make('celular')
                    ->required(),
                TextInput::make('latitud')
                    ->required()
                    ->numeric(),
                TextInput::make('longitud')
                    ->required()
                    ->numeric(),
                TextInput::make('ciudad')
                    ->required(),
                Textarea::make('direccion')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('ruta')
                    ->required(),
                TextInput::make('circuito')
                    ->required(),
                TextInput::make('banco')
                    ->required(),
                TextInput::make('nrocuenta')
                    ->required(),
            ]);
    }
}
