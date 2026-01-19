<?php

namespace App\Filament\Resources\Configapps\Pages;

use App\Filament\Resources\Configapps\ConfigappResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditConfigapp extends EditRecord
{
    protected static string $resource = ConfigappResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
