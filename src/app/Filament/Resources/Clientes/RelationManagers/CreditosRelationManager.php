<?php

namespace App\Filament\Resources\Clientes\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Actions\Action;
use App\Filament\Resources\Creditos\CreditoResource;
use App\Filament\Resources\Pagoscreditos\PagoscreditoResource;

class CreditosRelationManager extends RelationManager
{
    protected static string $relationship = 'creditos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('fechainicio')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('fechainicio')
            ->columns([
                TextColumn::make('id')
                    ->label('N°'),

                TextColumn::make('total')
                    ->money('BOB'),

                TextColumn::make('anticipo')
                    ->money('BOB'),

                TextColumn::make('saldo')
                    ->money('BOB')
                    ->color(fn ($state) => $state > 0 ? 'danger' : 'success')
                    ->weight('bold'),

                TextColumn::make('fechainicio')
                    ->label('Inicio')
                    ->date(),

                TextColumn::make('fechavencimiento')
                    ->label('Vence')
                    ->date()
                    ->color(fn ($record) =>
                        now()->greaterThan($record->fechavencimiento) && $record->saldo > 0
                            ? 'danger'
                            : null
                    ),

                BadgeColumn::make('estado')
                    ->colors([
                        'warning' => 'pendiente',
                        'success' => 'pagado',
                        'danger'  => 'vencido',
                    ]),
            ])
            ->defaultSort('fechavencimiento', 'asc')
            ->filters([
                //
            ])
            ->headerActions([
                // CreateAction::make(),
                // AssociateAction::make(),
            ])
            ->recordActions([
                // EditAction::make(),
                // DissociateAction::make(),
                DeleteAction::make(),
                Action::make('pagos')
                ->label('Pagos')
                ->icon('heroicon-o-banknotes')
                ->url(fn ($record) =>
                    // CreditoResource::getUrl('view', ['record' => $record])
                    // CreditoResource::getUrl('edit', ['record' => $record])
                    PagoscreditoResource::getUrl('index', [
                        'credito_id' => $record->id,
                    ])
                )
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
