<?php

namespace App\Filament\Resources\Carritos\Pages;

use App\Filament\Resources\Carritos\CarritoResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use Filament\Actions\Action;
use Filament\Forms\Components\Select;

class ViewCarrito extends ViewRecord
{
    protected static string $resource = CarritoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // EditAction::make(),
            Action::make('edit')
                ->label('Editar Estado')
                ->form([
                    Select::make('estado')
                        ->options([
                            'pendiente' => 'Pendiente',
                            'contactado' => 'Contactado',
                            'cancelado' => 'Cancelado',
                            'confirmado' => 'Confirmado',
                        ])
                        ->native(false)
                        ->required(),
                ])
                ->action(function (array $data, $record) {
                    $record->update(['estado' => $data['estado']]);
            }),
        ];
    }
}
