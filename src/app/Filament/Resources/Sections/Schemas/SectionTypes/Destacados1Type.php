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

class Destacados1Type
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
                                        ->directory('destacados')
                                        ->visibility('public')
                                        ->required(),
                           Repeater::make('imagenes')
                            ->label('Productos Destacados')
                            ->minItems(6)
                            ->maxItems(6)
                            ->validationMessages([
                                'min' => 'Debes agregar 6 imágenes',
                            ])
                            ->schema([
                                Grid::make()
                                ->schema([
                                    Placeholder::make('Imagen')
                                        ->label('')
                                        ->reactive()
                                        ->content(function ($get) {
                                            $id = $get('producto');
                                            // imagen por defecto si no hay producto o imagen
                                            $default = asset('imagenes/toolsplaceholder.png');
                                            if (! $id) {
                                                return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                            }
                                            $p = Inventario::find($id);
                                            // Log::info('p: ',$p);
                                            if (! $p || ! $p->img1) {
                                                return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                            }
                                            $path = asset('storage/' . $p->img1);
                                            return new HtmlString('<img src="'.$path.'" style="width:64px;height::64px;object-fit:cover;border-radius:8px;">');
                                        })
                                        ->columnSpan(1),
                                    Select::make('producto')->label('Producto')
                                        ->options($productos)->searchable()
                                        ->suffixAction(
                                            Action::make('editar')
                                                ->label('Editar')
                                                ->icon('heroicon-o-pencil-square')
                                                ->url(fn ($get) => $get('producto') 
                                                    ? route('filament.admin.resources.inventarios.edit', $get('producto'))
                                                    : null
                                                )
                                                ->openUrlInNewTab()
                                                ->disabled(fn ($get) => blank($get('producto')))
                                        )
                                        ->reactive()
                                        ->preload()
                                        // ->columns(2),
                                ])
                                // ->columns(2)
                            ])
                            // ->columns(2)
                            ->columnSpan(2),
                        ])
                        ->statePath('parametros');
    }
}