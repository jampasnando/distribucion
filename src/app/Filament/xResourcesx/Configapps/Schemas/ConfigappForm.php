<?php

namespace App\Filament\Resources\Configapps\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;

class ConfigappForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('whatsapp')
                    ->required(),
                TextInput::make('nrocuenta')
                    ->required(),
                TextInput::make('banco')
                    ->required(),
                TextInput::make('titularcuenta')
                    ->required(),
                TextInput::make('facebook'),
                TextInput::make('tiktok'),
                TextInput::make('latitud')
                    ->numeric(),
                TextInput::make('longitud')
                    ->numeric(),
                FileUpload::make('logo')
                    ->label('Logo (siempre debe ser logo.png)')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->preserveFilenames(true)
                    ->directory('images')
                    ->maxSize(1024)
                    ->required()
                    ->openable()
                    ->downloadable(),
                Textarea::make('horario')
                    ->rows(3),
            ]);
    }
}
