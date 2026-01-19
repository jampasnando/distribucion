<?php

namespace App\Filament\Resources\Destacado2s\Schemas;

use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class Destacado2Infolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('titulox'),
                TextEntry::make('imgx1'),
                TextEntry::make('imgx2'),
                TextEntry::make('imgx3'),
                TextEntry::make('imgx4'),
                TextEntry::make('tituloy'),
                TextEntry::make('imgy1'),
                TextEntry::make('imgy2'),
                TextEntry::make('imgy3'),
                TextEntry::make('imgy4'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                IconEntry::make('estado')
                    ->boolean(),
                TextEntry::make('orden')
                    ->numeric(),
            ]);
    }
}
