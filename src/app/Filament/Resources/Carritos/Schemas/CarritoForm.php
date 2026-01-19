<?php

namespace App\Filament\Resources\Carritos\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class CarritoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('productos'),
                TextInput::make('estado'),
                Textarea::make('comentario')
                    ->columnSpanFull(),
            ]);
    }
}
