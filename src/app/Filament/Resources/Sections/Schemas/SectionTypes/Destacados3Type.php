<?php

namespace App\Filament\Resources\Sections\Schemas\SectionTypes;

use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ColorPicker;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use App\Models\Inventario;
use Filament\Actions\Action;
use Filament\Forms\Components\Textarea;

class Destacados3Type
{
    public static function getSchema()
    {
        return Fieldset::make('parametros')
                        ->label('Parámetros')
                        ->schema([
                            Section::make('')
                                ->schema([
                                    TextInput::make('titulo')
                                    ->label('Título de la sección')
                                    ->required()
                                    ->columnSpan(3),
                                    Select::make('titulofont')
                                    ->label('Tipo letra')
                                    ->options([
                                        ''=>'Normal',
                                        'font-bebas'=>'Bebas',
                                        'font-kanit'=>'Kanit',
                                        'font-impact'=>'Impact',
                                        'font-franklin'=>'Franklin'
                                    ])
                                    ->default('')
                                    ->columnSpan(1)
                                    ->dehydrated()
                                    ->native(false),
                                    Select::make('titulosize')
                                    ->label('Tamaño')
                                    ->options([
                                        ''=>'Normal',
                                        'fs-6'=>'1',
                                        'fs-5'=>'2',
                                        'fs-4'=>'3',
                                        'fs-3'=>'4',
                                        'fs-2'=>'5',
                                        'fs-1'=>'6',
                                    ])
                                    ->default('')
                                    ->placeholder('Elija')
                                    ->dehydrated()
                                    ->native(false),
                                    Toggle::make('titulobold')
                                    ->label('Negrita'),
                                    ColorPicker::make('titulocolor')
                                    ->label('Color del título'),
                                    ColorPicker::make('bgcolor')
                                    ->label('Color de fondo'),
                                ])
                                ->columns(8)
                                ->columnSpanFull(),
                            
                            fileUpload::make('imagen_destacada')
                                        ->label('Imagen destacada')
                                        ->disk('public')
                                        ->directory('destacados3')
                                        ->visibility('public')
                                        ->required(),
                            Repeater::make('cards')
                                    ->label('Cards')
                                    ->minItems(1)
                                    ->maxItems(6)
                                    ->schema([
                                        fileUpload::make('imagen')
                                            ->label('Una Imagen')
                                            ->disk('public')
                                            ->directory('destacados3')
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
                                    // ->columns(5)
                            ])
                        ->statePath('parametros');       
    }
}