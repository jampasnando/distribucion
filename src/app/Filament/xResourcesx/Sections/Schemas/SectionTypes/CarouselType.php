<?php

namespace App\Filament\Resources\Sections\Schemas\SectionTypes;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;

class CarouselType
{
    public static function getSchema()
    {
        return Repeater::make('parametros')
            ->label('Imágenes del Carrusel')
            ->minItems(1)
            ->schema([
                FileUpload::make('unaimagen')
                    ->label('Una Imagen')
                    ->disk('public')
                    ->directory('carruseles')
                    ->visibility('public')
                    ->required(),
            ])
            ->columnSpanFull();
    }
}