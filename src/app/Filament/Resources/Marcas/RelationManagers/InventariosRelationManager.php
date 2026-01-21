<?php

namespace App\Filament\Resources\Marcas\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class InventariosRelationManager extends RelationManager
{
    protected static string $relationship = 'inventarios';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('idprod'),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                TextInput::make('cantidad')
                    ->numeric()
                    ->default(0),
                TextInput::make('categoria'),
                TextInput::make('unidad'),
                TextInput::make('preciocompra')
                    ->numeric()
                    ->default(0),
                TextInput::make('precioventa')
                    ->numeric()
                    ->default(0),
                TextInput::make('comision')
                    ->numeric()
                    ->default(0),
                TextInput::make('deposito'),
                TextInput::make('proveedor_id')
                    ->numeric(),
                Textarea::make('imagenes')
                    ->columnSpanFull(),
                TextInput::make('img1'),
                TextInput::make('img2'),
                TextInput::make('img3'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('idprod')
            ->columns([
                TextColumn::make('idprod')
                    ->searchable(),
                TextColumn::make('cantidad')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('categoria')
                    ->searchable(),
                TextColumn::make('unidad')
                    ->searchable(),
                TextColumn::make('preciocompra')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('precioventa')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('comision')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('proveedor.nombre')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('img1')
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
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
