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
                TextInput::make('nit'),
                TextInput::make('telefono')
                    ->tel(),
                TextInput::make('celular'),
                TextInput::make('latitud')
                    ->numeric(),
                TextInput::make('longitud')
                    ->numeric(),
                TextInput::make('ciudad'),
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
