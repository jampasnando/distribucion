<?php

namespace App\Filament\Resources\Proveedores\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ProveedoreForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                Textarea::make('direccion')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('ciudad')
                    ->required(),
                TextInput::make('contacto')
                    ->required(),
                TextInput::make('telefono')
                    ->tel()
                    ->required(),
            ]);
    }
}
