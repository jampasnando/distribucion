<?php

namespace App\Filament\Resources\Inventarios\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class InventarioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('idprod'),
                TextEntry::make('marca.nombre'),
                TextEntry::make('descripcion'),
                TextEntry::make('cantidad')
                    ->numeric(),
                TextEntry::make('preciocompra')
                    ->numeric(),
                TextEntry::make('precioventa')
                    ->numeric(),
                TextEntry::make('comision')
                    ->numeric(),
                TextEntry::make('proveedor.nombre'),
                TextEntry::make('img1'),
                TextEntry::make('created_at')
                    ->dateTime(),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ])
            ->columns(4);
    }
}
