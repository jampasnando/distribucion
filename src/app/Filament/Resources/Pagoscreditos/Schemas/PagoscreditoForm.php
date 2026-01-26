<?php

namespace App\Filament\Resources\Pagoscreditos\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;

class PagoscreditoForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('credito_id')
                    ->numeric()
                    ->default(fn () => request()->get('credito_id'))
                    ->disabled()
                    ->dehydrated(),
                TextInput::make('monto')
                    ->numeric(),
                DateTimePicker::make('fechapago')
                    ->default(now()),
                Select::make('metodopago')
                        ->options([
                            'contado' => 'Contado',
                            'qr' => 'QR',
                            'tarjeta' => 'Tarjeta',
                            'transferencia' => 'Transferencia'
                            // 'credito' => 'Crédito',
                        ])
                        ->default('contado'),
                Textarea::make('comentarios')
                    ->columnSpanFull(),
            ]);
    }
}
