<?php

namespace App\Filament\Resources\Carrusels\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CarruselInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('imagen'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
                TextEntry::make('orden')
                    ->numeric(),
            ]);
    }
}
