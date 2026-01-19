<?php

namespace App\Filament\Resources\Destacado2s;

use App\Filament\Resources\Destacado2s\Pages\CreateDestacado2;
use App\Filament\Resources\Destacado2s\Pages\EditDestacado2;
use App\Filament\Resources\Destacado2s\Pages\ListDestacado2s;
use App\Filament\Resources\Destacado2s\Pages\ViewDestacado2;
use App\Filament\Resources\Destacado2s\Schemas\Destacado2Form;
use App\Filament\Resources\Destacado2s\Schemas\Destacado2Infolist;
use App\Filament\Resources\Destacado2s\Tables\Destacado2sTable;
use App\Models\Destacado2;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class Destacado2Resource extends Resource
{
    protected static ?string $model = Destacado2::class;
    protected static string | UnitEnum | null $navigationGroup = 'TiendaOnline';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Destacado2s';
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
        return Destacado2Form::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return Destacado2Infolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return Destacado2sTable::configure($table);
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
            'index' => ListDestacado2s::route('/'),
            'create' => CreateDestacado2::route('/create'),
            'view' => ViewDestacado2::route('/{record}'),
            'edit' => EditDestacado2::route('/{record}/edit'),
        ];
    }
}
