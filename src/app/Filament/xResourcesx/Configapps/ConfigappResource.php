<?php

namespace App\Filament\Resources\Configapps;

use App\Filament\Resources\Configapps\Pages\CreateConfigapp;
use App\Filament\Resources\Configapps\Pages\EditConfigapp;
use App\Filament\Resources\Configapps\Pages\ListConfigapps;
use App\Filament\Resources\Configapps\Pages\ViewConfigapp;
use App\Filament\Resources\Configapps\Schemas\ConfigappForm;
use App\Filament\Resources\Configapps\Schemas\ConfigappInfolist;
use App\Filament\Resources\Configapps\Tables\ConfigappsTable;
use App\Models\Configapp;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ConfigappResource extends Resource
{
    protected static ?string $model = Configapp::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    // protected static ?string $recordTitleAttribute = '';

    public static function form(Schema $schema): Schema
    {
        return ConfigappForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ConfigappInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ConfigappsTable::configure($table);
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
            'index' => ListConfigapps::route('/'),
            'create' => CreateConfigapp::route('/create'),
            'view' => ViewConfigapp::route('/{record}'),
            'edit' => EditConfigapp::route('/{record}/edit'),
        ];
    }
}
