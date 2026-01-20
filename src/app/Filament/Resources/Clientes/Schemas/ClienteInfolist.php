<?php

namespace App\Filament\Resources\Clientes\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ClienteInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('nombre'),
                TextEntry::make('ci'),
                TextEntry::make('nit'),
                TextEntry::make('telefono'),
                TextEntry::make('celular'),
                TextEntry::make('latitud')
                    ->numeric(),
                TextEntry::make('longitud')
                    ->numeric(),
                TextEntry::make('ciudad'),
                TextEntry::make('ruta'),
                TextEntry::make('circuito'),
                TextEntry::make('banco'),
                TextEntry::make('nrocuenta'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
