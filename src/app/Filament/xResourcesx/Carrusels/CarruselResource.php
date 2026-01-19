<?php

namespace App\Filament\Resources\Carrusels;

use App\Filament\Resources\Carrusels\Pages\CreateCarrusel;
use App\Filament\Resources\Carrusels\Pages\EditCarrusel;
use App\Filament\Resources\Carrusels\Pages\ListCarrusels;
use App\Filament\Resources\Carrusels\Pages\ViewCarrusel;
use App\Filament\Resources\Carrusels\Schemas\CarruselForm;
use App\Filament\Resources\Carrusels\Schemas\CarruselInfolist;
use App\Filament\Resources\Carrusels\Tables\CarruselsTable;
use App\Models\Carrusel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CarruselResource extends Resource
{
    protected static ?string $model = Carrusel::class;
    protected static string | UnitEnum | null $navigationGroup = 'TiendaOnline';


    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'Carrusel';
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
        return CarruselForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return CarruselInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarruselsTable::configure($table);
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
            'index' => ListCarrusels::route('/'),
            'create' => CreateCarrusel::route('/create'),
            'view' => ViewCarrusel::route('/{record}'),
            'edit' => EditCarrusel::route('/{record}/edit'),
        ];
    }
}
