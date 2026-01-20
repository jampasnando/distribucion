<?php

namespace App\Filament\Resources\Inventarios\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Forms\Components\FileUpload;
use Filament\Infolists\Components\ImageEntry;
class InventarioInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID')
                    ->numeric(),
                TextEntry::make('idprod'),
                TextEntry::make('marca'),
                TextEntry::make('cantidad')
                    ->numeric(),
                TextEntry::make('categoria'),
                TextEntry::make('unidad'),
                TextEntry::make('preciocompra')
                    ->label('PrecioC')
                    ->numeric()
                    ->visible(fn () => auth()->user()->role === 'administrador'),
                TextEntry::make('precioventa')
                    ->numeric(),
                TextEntry::make('comision')
                    ->numeric()
                    ->visible(fn () => auth()->user()->role === 'administrador'),
                TextEntry::make('deposito'),
                TextEntry::make('proveedor'),
                ImageEntry::make('img1')
                ->disk('public')
                ->visibility('public'),
                ImageEntry::make('img2')
                ->disk('public'),
                // ->height(200),
                // ->circular(false),
                ImageEntry::make('img3')
                ->disk('public')
                // ->height(200)
                // ->circular(false),
            ]);
    }
}
