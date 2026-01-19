<?php

namespace App\Filament\Resources\Listas\Pages;

use App\Filament\Resources\Listas\ListaResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditLista extends EditRecord
{
    protected static string $resource = ListaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
