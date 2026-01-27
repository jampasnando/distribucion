<?php

namespace App\Filament\Resources\Ventas\Pages;

use App\Filament\Resources\Ventas\VentaResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListVentas extends ListRecords
{
    protected static string $resource = VentaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            'Todo' => Tab::make(),
            'Al contado' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('formapago', 'contado')),
            'A crédito' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('formapago', 'credito')),
        ];
    }
}
