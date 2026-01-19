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
use App\Models\Marca;

class MarcasType
{
    public static function getSchema()
    {
        $marcas = Marca::orderBy('logo','desc')->orderBy('nombre')->get()->mapWithKeys(function ($p) {
                    if($p->logo == NULL) {
                        $foto= 'NoFoto';
                    }
                    else {
                        $foto= 'HayFoto';
                    }
                    return [
                        $p->id => "{$p->nombre} - ({$foto})",
                    ];
                    })->toArray();
        return Fieldset::make('parametros')
                        ->schema([
                            TextInput::make('titulo')
                                ->label('Título de la sección')
                                ->required(),
                           Repeater::make('imagenes')
                            ->label('Marcas')
                            ->minItems(5)
                            // ->validationMessages([
                            //     'min' => 'Debes agregar 6 imágenes',
                            // ])
                            ->schema([
                                Grid::make()
                                ->schema([
                                    Placeholder::make('Imagen')
                                        ->label('')
                                        ->reactive()
                                        ->content(function ($get) {
                                            $id = $get('marca');
                                            // imagen por defecto si no hay producto o imagen
                                            $default = asset('imagenes/toolsplaceholder.png');
                                            if (! $id) {
                                                return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                            }
                                            $p = Marca::find($id);
                                            if (! $p || ! $p->logo) {
                                                return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                            }
                                            $path = asset('storage/' . $p->logo);
                                            return new HtmlString('<img src="'.$path.'" style="width:64px;height::64px;object-fit:cover;border-radius:8px;">');
                                        })
                                        ->columnSpan(1),
                                    Select::make('marca')->label('Marca')
                                        ->options($marcas)->searchable()
                                        ->suffixAction(
                                            Action::make('editar')
                                                ->label('Editar')
                                                ->icon('heroicon-o-pencil-square')
                                                ->url(fn ($get) => $get('marca') 
                                                    ? route('filament.admin.resources.marcas.edit', $get('marca'))
                                                    : null
                                                )
                                                ->openUrlInNewTab()
                                                ->disabled(fn ($get) => blank($get('marca')))
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