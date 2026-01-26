<?php

namespace App\Filament\Resources\Pagoscreditos\Pages;

use App\Filament\Resources\Pagoscreditos\PagoscreditoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPagoscredito extends EditRecord
{
    protected static string $resource = PagoscreditoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
