<?php

namespace App\Filament\Resources\Pagoscreditos;

use App\Filament\Resources\Pagoscreditos\Pages\CreatePagoscredito;
use App\Filament\Resources\Pagoscreditos\Pages\EditPagoscredito;
use App\Filament\Resources\Pagoscreditos\Pages\ListPagoscreditos;
use App\Filament\Resources\Pagoscreditos\Schemas\PagoscreditoForm;
use App\Filament\Resources\Pagoscreditos\Tables\PagoscreditosTable;
use App\Models\Pagoscredito;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PagoscreditoResource extends Resource
{
    protected static ?string $model = Pagoscredito::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'fechapago';

    public static function form(Schema $schema): Schema
    {
        return PagoscreditoForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PagoscreditosTable::configure($table);
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
            'index' => ListPagoscreditos::route('/'),
            'create' => CreatePagoscredito::route('/create'),
            'edit' => EditPagoscredito::route('/{record}/edit'),
        ];
    }
}
