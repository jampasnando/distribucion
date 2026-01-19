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

class Destacados2Type
{
    public static function getSchema()
    {
        $productos = Inventario::where('cantidad', '>', 0)->get()->mapWithKeys(function ($p) {
                    if($p->img1 == NULL) {
                        $foto= 'NoFoto';
                    }
                    else {
                        $foto= 'HayFoto';
                    }
                    return [
                        $p->id => "{$p->descripcion} - Bs. {$p->precioventa} - Stock: {$p->cantidad} ({$foto})",
                    ];
                    })->toArray();
        return Fieldset::make('parametros')
                        ->label('Parámetros')   
                                ->schema([
                                    Section::make('') // Primera sección (titulox + imgx1..imgx4)xy
                                        ->schema([
                                                ColorPicker::make('color')
                                                ->label('Color de fondo toda la sección'),
                                                Select::make('titulofontX')
                                                ->label('Tipo letraX')
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
                                                Select::make('tamtituloX')
                                                ->label('TamañoX')
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
                                                Toggle::make('negritaX')
                                                ->label('NegritaX'),
                                                ColorPicker::make('colorletraX')
                                                ->label('Color tituloX'),
                                                ColorPicker::make('bgcolorX')
                                                ->label('Color de fondoX'),
                                                //////////////////////// para Y ////////////////////////
                                                Select::make('titulofontY')
                                                ->label('Tipo letraY')
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
                                                Select::make('tamtituloY')
                                                ->label('TamañoY')
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
                                                Toggle::make('negritaY')
                                                ->label('NegritaY'),
                                                ColorPicker::make('colorletraY')
                                                ->label('Color tituloY'),
                                                ColorPicker::make('bgcolorY')
                                                ->label('Color de fondoY'),
                                        ])
                                        ->columns(6)
                                        ->columnSpanFull(), 
                                                               
                                    Section::make('Sección X')
                                        ->schema([
                                            TextInput::make('titulox'),
                                            
                                            Grid::make(2) // 4 columnas para que las imágenes vayan en una sola fila
                                                ->schema([
                                                    Select::make('imgx1')->label('Producto 1')->options($productos)->searchable()
                                                    ->preload(),
                                                    Select::make('imgx2')->label('Producto 2')->options($productos)->searchable()
                                                    ->preload(),
                                                    Select::make('imgx3')->label('Producto 3')->options($productos)->searchable()
                                                    ->preload(),
                                                    Select::make('imgx4')->label('Producto 4')->options($productos)->searchable()
                                                    ->preload(),
                                                ]),
                                        ]),

                                    // Segunda sección (tituloy + imgy1..imgy4)
                                    Section::make('Sección Y')
                                        ->schema([
                                            TextInput::make('tituloY')
                                                ->columnSpanFull(),

                                            Grid::make(2) // 4 columnas para que las imágenes vayan en una sola fila
                                                ->schema([
                                                    Select::make('imgy1')->label('Producto 5')->options($productos)->searchable()
                                                    ->preload(),
                                                    Select::make('imgy2')->label('Producto 6')->options($productos)->searchable()
                                                    ->preload(),
                                                    Select::make('imgy3')->label('Producto 7')->options($productos)->searchable()
                                                    ->preload(),
                                                    Select::make('imgy4')->label('Producto 8')->options($productos)->searchable()
                                                    ->preload(),
                                                ]),
                                        ]),

                                    // Otros campos
                                ])
                                ->statePath('parametros');    
    }
}