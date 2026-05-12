<?php

namespace App\Filament\Resources\Creditos\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class PagoscreditosRelationManager extends RelationManager
{
    protected static string $relationship = 'pagoscreditos';
    protected static ?string $recordTitleAttribute = 'fechapago';
    protected static ?string $title = 'Pagos del Crédito';
    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('credito_id')
                    ->default(fn ($livewire) => $livewire->ownerRecord->id)
                    ->disabled()
                    ->dehydrated()
                    ->numeric(),
                TextInput::make('monto')
                    ->numeric(),
                DateTimePicker::make('fechapago')
                    ->default(now()),
                Select::make('metodopago')
                    ->options([
                        'efectivo' => 'Efectivo',
                        'transferencia' => 'Transferencia',
                        'tarjeta' => 'Tarjeta',
                        'qr' => 'QR',
                    ])
                    ->default('efectivo'),
                Textarea::make('comentarios')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fechapago')
            ->columns([
                TextColumn::make('credito_id')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('monto')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('fechapago')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('metodopago')
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('Registrar Pago'),
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
