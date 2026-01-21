<?php

namespace App\Filament\Resources\Compras\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class CompraInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('deposito_id')
                    ->numeric(),
                TextEntry::make('idcompra'),
                TextEntry::make('total')
                    ->numeric(),
                TextEntry::make('proveedor_id')
                    ->numeric(),
                TextEntry::make('nit'),
                TextEntry::make('formapago'),
                TextEntry::make('fecha')
                    ->dateTime(),
                TextEntry::make('user_id')
                    ->numeric(),
                TextEntry::make('factura'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at'),
            ]);
    }
}
