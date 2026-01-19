<?php

namespace App\Filament\Resources\Destacados\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DestacadoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titulo'),
                TextEntry::make('orden'),
                TextEntry::make('imgdestacada'),
                TextEntry::make('prod1'),
                TextEntry::make('prod2'),
                TextEntry::make('prod3'),
                TextEntry::make('prod4'),
                TextEntry::make('prod5'),
                TextEntry::make('prod6'),
                IconEntry::make('estado')
                    ->boolean(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
