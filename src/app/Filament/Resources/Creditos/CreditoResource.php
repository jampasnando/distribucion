<?php

namespace App\Filament\Resources\Creditos;

use App\Filament\Resources\Creditos\Pages\CreateCredito;
use App\Filament\Resources\Creditos\Pages\EditCredito;
use App\Filament\Resources\Creditos\Pages\ListCreditos;
use App\Filament\Resources\Creditos\Schemas\CreditoForm;
use App\Filament\Resources\Creditos\Tables\CreditosTable;
use App\Models\Credito;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CreditoResource extends Resource
{
    protected static ?string $model = Credito::class;
     protected static string | UnitEnum | null $navigationGroup = 'Ventas';
    protected static ?string $navigationLabel = 'Creditos';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CreditoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CreditosTable::configure($table);
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
            'index' => ListCreditos::route('/'),
            'create' => CreateCredito::route('/create'),
            'edit' => EditCredito::route('/{record}/edit'),
        ];
    }
}
