<?php

namespace App\Filament\Resources\Carrusels\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class CarruselForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('imagen')
                    ->image()
                    ->disk('public')
                    ->directory('carruseles')
                    ->downloadable()
                    ->visibility('public')
                    ->required(),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
