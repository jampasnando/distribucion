<?php

namespace App\Filament\Resources\Configapps\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ConfigappInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('whatsapp'),
                TextEntry::make('nrocuenta'),
                TextEntry::make('banco'),
                TextEntry::make('titularcuenta'),
                TextEntry::make('facebook'),
                TextEntry::make('tiktok'),
            ]);
    }
}
