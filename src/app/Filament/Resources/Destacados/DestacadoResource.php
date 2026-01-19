<?php

namespace App\Filament\Resources\Destacados;

use App\Filament\Resources\Destacados\Pages\CreateDestacado;
use App\Filament\Resources\Destacados\Pages\EditDestacado;
use App\Filament\Resources\Destacados\Pages\ListDestacados;
use App\Filament\Resources\Destacados\Pages\ViewDestacado;
use App\Filament\Resources\Destacados\Schemas\DestacadoForm;
use App\Filament\Resources\Destacados\Schemas\DestacadoInfolist;
use App\Filament\Resources\Destacados\Tables\DestacadosTable;
use App\Models\Destacado;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class DestacadoResource extends Resource
{
    protected static ?string $model = Destacado::class;
    protected static string | UnitEnum | null $navigationGroup = 'TiendaOnline';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Destacado';
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
        return DestacadoForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DestacadoInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DestacadosTable::configure($table);
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
            'index' => ListDestacados::route('/'),
            'create' => CreateDestacado::route('/create'),
            'view' => ViewDestacado::route('/{record}'),
            'edit' => EditDestacado::route('/{record}/edit'),
        ];
    }
}
