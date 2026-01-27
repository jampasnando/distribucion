<?php

namespace App\Filament\Resources\Creditos\Pages;

use App\Filament\Resources\Creditos\CreditoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Credito;

class ListCreditos extends ListRecords
{
    protected static string $resource = CreditoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        return [
            
            'Activos' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('estado', 'activo'))
                ->badge(Credito::query()->where('estado', 'activo')->count()),
            'Cancelados' => Tab::make()
                ->modifyQueryUsing(fn (Builder $query) => $query->where('estado', 'cancelado'))
                ->badge(Credito::query()->where('estado', 'cancelado')->count()),
            'Todo' => Tab::make(),
        ];
    }
}
