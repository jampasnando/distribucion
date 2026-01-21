<?php

namespace App\Filament\Resources\Proveedores;

use App\Filament\Resources\Proveedores\Pages\CreateProveedore;
use App\Filament\Resources\Proveedores\Pages\EditProveedore;
use App\Filament\Resources\Proveedores\Pages\ListProveedores;
use App\Filament\Resources\Proveedores\Pages\ViewProveedore;
use App\Filament\Resources\Proveedores\Schemas\ProveedoreForm;
use App\Filament\Resources\Proveedores\Schemas\ProveedoreInfolist;
use App\Filament\Resources\Proveedores\Tables\ProveedoresTable;
use App\Models\Proveedore;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ProveedoreResource extends Resource
{
    protected static ?string $model = Proveedore::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return ProveedoreForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ProveedoreInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProveedoresTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProveedores::route('/'),
            'create' => CreateProveedore::route('/create'),
            'view' => ViewProveedore::route('/{record}'),
            'edit' => EditProveedore::route('/{record}/edit'),
        ];
    }
}
