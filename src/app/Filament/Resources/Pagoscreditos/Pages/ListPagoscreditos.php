<?php

namespace App\Filament\Resources\Pagoscreditos\Pages;

use App\Filament\Resources\Pagoscreditos\PagoscreditoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;


class ListPagoscreditos extends ListRecords
{
    protected static string $resource = PagoscreditoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
    protected function getTableQuery(): Builder
    {
        $query = parent::getTableQuery();

        if ($creditoId = request()->get('credito_id')) {
            $query->where('credito_id', $creditoId);
        }

        return $query;
    }
}
