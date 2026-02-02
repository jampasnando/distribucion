<?php

namespace App\Filament\Resources\Inventarios;

use App\Filament\Resources\Inventarios\Pages\CreateInventario;
use App\Filament\Resources\Inventarios\Pages\EditInventario;
use App\Filament\Resources\Inventarios\Pages\ListInventarios;
use App\Filament\Resources\Inventarios\Pages\ViewInventario;
use App\Filament\Resources\Inventarios\Schemas\InventarioForm;
use App\Filament\Resources\Inventarios\Schemas\InventarioInfolist;
use App\Filament\Resources\Inventarios\Tables\InventariosTable;
use App\Models\Inventario;
use BackedEnum;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class InventarioResource extends Resource
{
    protected static ?string $model = Inventario::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return InventarioForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return InventarioInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return InventariosTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\VentasRelationManager::class,
            RelationManagers\OfertasRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListInventarios::route('/'),
            'create' => CreateInventario::route('/create'),
            'view' => ViewInventario::route('/{record}'),
            'edit' => EditInventario::route('/{record}/edit'),
        ];
    }
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'ofertas' => function ($query) {
                    $query
                        ->where('activo', true)
                        ->whereDate('fecha_inicio', '<=', now())
                        ->whereDate('fecha_fin', '>=', now());
                }
            ]);
    }
}
