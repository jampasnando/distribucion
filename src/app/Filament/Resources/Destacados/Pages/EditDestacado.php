<?php

namespace App\Filament\Resources\Destacados\Pages;

use App\Filament\Resources\Destacados\DestacadoResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDestacado extends EditRecord
{
    protected static string $resource = DestacadoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
