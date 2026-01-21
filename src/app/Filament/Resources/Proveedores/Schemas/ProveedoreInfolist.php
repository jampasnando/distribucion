<?php

namespace App\Filament\Resources\Proveedores\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ProveedoreInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('ciudad'),
                TextEntry::make('contacto'),
                TextEntry::make('telefono'),
            ]);
    }
}
