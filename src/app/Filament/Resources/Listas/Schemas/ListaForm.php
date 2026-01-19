<?php

namespace App\Filament\Resources\Listas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ListaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('clave'),
                Toggle::make('estado')
                    ->required()
                    ->default(true),
                TextInput::make('limite')
                    ->required()
                    ->numeric()
                    ->default(6),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
