<?php

namespace App\Filament\Resources\Destacado2s\Pages;

use App\Filament\Resources\Destacado2s\Destacado2Resource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditDestacado2 extends EditRecord
{
    protected static string $resource = Destacado2Resource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
