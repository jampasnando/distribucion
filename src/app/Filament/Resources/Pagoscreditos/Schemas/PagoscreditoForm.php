<?php

namespace App\Filament\Resources\Pagoscreditos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class PagoscreditoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('credito_id')
                    ->numeric(),
                TextInput::make('monto')
                    ->numeric(),
                DateTimePicker::make('fechapago'),
                TextInput::make('metodopago'),
                Textarea::make('comentarios')
                    ->columnSpanFull(),
            ]);
    }
}
