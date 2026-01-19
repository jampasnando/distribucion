<?php

namespace App\Filament\Resources\Sections\Schemas\SectionTypes;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Fieldset;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Actions\Action;
use Illuminate\Support\HtmlString;
use App\Models\Inventario;
use App\Models\Marca;
use Filament\Forms\Components\Toggle;

class Lista1Type
{
    public static function getSchema()
    {
        $listacategorias = Inventario::query()
                                 ->select('categoria')
                                 ->distinct()
                                 ->orderBy('categoria')
                                 ->get()
                                 ->pluck('categoria', 'categoria')
                                 ->toArray();
        return Fieldset::make('parametros')
                        ->schema([
                            TextInput::make('titulo')
                                ->required()
                                ->maxLength(255),
                            Toggle::make('conimagenes')
                                ->label('Que tengan foto')
                                ->default(true),
                            Repeater::make('categorias')
                                ->label('Categorías')
                                ->schema([
                                    Select::make('categoria')->label('Categoría')
                                    ->options($listacategorias)
                                    ->searchable()
                                ]),
                            
                            Repeater::make('marcas')
                                ->label('Marcas')
                                ->schema([
                                    Select::make('marca')->label('Marca')
                                        ->options(Marca::pluck('nombre','nombre'))
                                        ->searchable()
                                        ->preload()
                                ])
                                ->minItems(1)
                                ->createItemButtonLabel('Agregar marca')
                                ->validationMessages([
                                    'min' => 'Debes agregar al menos una marca.',
                                ])
                                ->columns(1),
                            
                        ])
                        ->columnSpanFull()
                        ->statePath('parametros');
    }
}