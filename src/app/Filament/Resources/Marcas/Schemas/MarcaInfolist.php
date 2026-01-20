<?php

namespace App\Filament\Resources\Marcas\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class MarcaInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('pais'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at'),
                TextEntry::make('logo'),
            ]);
    }
}
