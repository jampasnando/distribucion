<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class SectionInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('tipo'),
                TextEntry::make('estado'),
                TextEntry::make('orden')
                    ->numeric(),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
