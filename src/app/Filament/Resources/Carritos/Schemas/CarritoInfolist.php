<?php

namespace App\Filament\Resources\Carritos\Schemas;

use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
class CarritoInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->schema([
                TextEntry::make('created_at')
                    ->dateTime()
                    ->label('Fecha'),
                TextEntry::make('id')
                    ->label('Pedido Nº')
                    ->weight('bold'),

                TextEntry::make('estado')
                    ->badge()
                    ->color(fn (?string $state) => match ($state) {
                        'pendiente' => 'warning',
                        'contactado' => 'info',
                        'cancelado' => 'danger',
                        'confirmado' => 'success',
                        default => 'gray',
                    }),

                RepeatableEntry::make('productos')
                    ->label('Productos')
                    ->schema([
                        ImageEntry::make('img')
                            ->height(60)
                            ->circular(),

                        TextEntry::make('nombre')
                            ->weight('bold')
                            ->columnSpan(2),

                        TextEntry::make('cantidad')
                            ->label('Cant.'),

                        TextEntry::make('precio')
                            ->label('Precio')
                            // ->money('BOB'),
                    ])
                    ->columns(5),

                
                TextEntry::make('resumen_productos')
                    ->label('Resumen')
                    ->weight('extrabold')
                    ->alignEnd()
                    ->size('lg')
                    ->badge()
                    ->color('success')
                    ->columnSpanFull(),
                TextEntry::make('comentarios')
                    ->label('Comentarios')
                    ->placeholder('-')
                    ->columnSpanFull(),
                    ],
        );
    }
}
