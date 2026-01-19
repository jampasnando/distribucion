<?php

namespace App\Filament\Resources\Marcas\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class MarcaForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nombre')
                    ->required(),
                TextInput::make('pais'),
                FileUpload::make('logo')
                    ->image()
                    ->disk('public')
                    ->directory('marcas')
                    ->downloadable()
                    ->visibility('public')
                    ->imageEditor(),
                Toggle::make('carrusel')
                    ->required(),
            ]);
    }
}
