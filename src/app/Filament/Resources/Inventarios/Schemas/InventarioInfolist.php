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
                TextEntry::make('marca'),
                TextEntry::make('cantidad')
                    ->numeric(),
                TextEntry::make('categoria'),
                TextEntry::make('unidad'),
                TextEntry::make('preciocompra')
                    ->numeric(),
                TextEntry::make('precioventa')
                    ->numeric(),
                TextEntry::make('comision')
                    ->numeric(),
                TextEntry::make('deposito'),
                TextEntry::make('proveedor'),
                TextEntry::make('img1'),
                TextEntry::make('img2'),
                TextEntry::make('img3'),
                TextEntry::make('updated_at')
                    ->dateTime(),
            ]);
    }
}
