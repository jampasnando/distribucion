<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditCliente extends EditRecord
{
    protected static string $resource = ClienteResource::class;
    protected $listeners = ['map-selected' => 'setLocation'];

    public function setLocation($lat, $lng): void
    {
        $this->data['latitud'] = round((float) $lat, 7);
        $this->data['longitud'] = round((float) $lng, 7);

        $this->dispatch('close-modal', id: 'seleccionarMapa');
    }
    
    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
