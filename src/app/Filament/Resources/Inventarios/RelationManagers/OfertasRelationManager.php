<?php

namespace App\Filament\Resources\Inventarios\RelationManagers;

use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Forms\Components\Toggle;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Actions\DissociateBulkAction;
use Filament\Forms\Components\ToggleButtons;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Columns\ToggleColumn;

class OfertasRelationManager extends RelationManager
{
    protected static string $relationship = 'ofertas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('precio_oferta')
                    ->label('Precio de oferta')
                    ->numeric()
                    ->required(),

                DatePicker::make('fecha_inicio')
                    ->required(),

                DatePicker::make('fecha_fin')
                    ->required()
                    ->after('fecha_inicio'),

                Toggle::make('activo')
                    ->default(true),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fecha_inicio')
            ->columns([
                TextColumn::make('precio_oferta')
                    ->label('Precio')
                    ->money('BOB'),

                TextColumn::make('fecha_inicio')
                    ->date(),

                TextColumn::make('fecha_fin')
                    ->date(),

                ToggleColumn::make('activo'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                // AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                // DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
