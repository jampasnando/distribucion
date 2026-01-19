<?php

namespace App\Filament\Resources\Sections\Schemas\SectionTypes;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class Cards5Type
{
    public static function getSchema()
    {
        return Repeater::make('parametros')
                                ->label('Cards')
                                ->minItems(1)
                                ->schema([
                                    fileUpload::make('imagen')
                                        ->label('Una Imagen')
                                        ->disk('public')
                                        ->directory('cards')
                                        ->visibility('public')
                                        ->required(),
                                    Textarea::make('texto')
                                        ->label('Texto de la card'),
                                    TextInput::make('productos')
                                        ->label('SKUs de productos (separados por coma)')
                                       ->dehydrateStateUsing(function ($state) {
                                            // Guardar siempre como array en el JSON
                                            if (is_string($state)) {
                                                $arr = array_filter(array_map('trim', explode(',', $state)));
                                                return array_values($arr);
                                            }
                                            if (is_array($state)) {
                                                return array_values($state);
                                            }
                                            return [];
                                        })
                                        ->formatStateUsing(function ($state) {
                                            // Mostrar como "a, b, c" en el formulario al editar
                                            if (is_array($state)) {
                                                return implode(', ', $state);
                                            }
                                            return $state;
                                        }),
                                ])
                                ->columns(5);
    }
}