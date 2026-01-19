<?php

namespace App\Filament\Resources\Listas;

use App\Filament\Resources\Listas\Pages\CreateLista;
use App\Filament\Resources\Listas\Pages\EditLista;
use App\Filament\Resources\Listas\Pages\ListListas;
use App\Filament\Resources\Listas\Pages\ViewLista;
use App\Filament\Resources\Listas\Schemas\ListaForm;
use App\Filament\Resources\Listas\Schemas\ListaInfolist;
use App\Filament\Resources\Listas\Tables\ListasTable;
use App\Models\Lista;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class ListaResource extends Resource
{
    protected static ?string $model = Lista::class;
    protected static string | UnitEnum | null $navigationGroup = 'TiendaOnline';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Listas';
    public static function canAccess(): bool
    {
        return auth()->check() && auth()->user()->role === 'administrador';
    }

    public static function canViewAny(): bool
    {
        return auth()->check() && auth()->user()->role === 'administrador';
    }

    public static function form(Schema $schema): Schema
    {
        return ListaForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ListaInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ListasTable::configure($table);
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
            'index' => ListListas::route('/'),
            'create' => CreateLista::route('/create'),
            'view' => ViewLista::route('/{record}'),
            'edit' => EditLista::route('/{record}/edit'),
        ];
    }
}
