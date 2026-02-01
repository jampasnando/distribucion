<?php

namespace App\Filament\Resources\Clientes\Pages;

use App\Filament\Resources\Clientes\ClienteResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCliente extends CreateRecord
{
    protected static string $resource = ClienteResource::class;
    protected $listeners = ['map-selected' => 'setLocation'];

    public function setLocation($lat, $lng): void
    {
        $this->data['latitud'] = round((float) $lat, 7);
        $this->data['longitud'] = round((float) $lng, 7);

        $this->dispatch('close-modal', id: 'seleccionarMapa');
    }
}
