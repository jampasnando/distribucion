<?php

namespace App\Filament\Resources\Destacados\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use App\Models\Inventario;
use Filament\Actions\Action;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Illuminate\Support\HtmlString;
use Illuminate\Support\Facades\Log;

class DestacadoForm
{
    public static function configure(Schema $schema): Schema
    {
        $productos = Inventario::all()->mapWithKeys(function ($p) {
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
        return $schema
            ->components([
                TextInput::make('titulo'),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                
                FileUpload::make('imgdestacada')
                    ->image()
                    ->disk('public')
                    ->directory('destacados')
                    ->downloadable()
                    ->visibility('public')
                    ->imageEditor()
                    ->required(),
                Toggle::make('estado')
                    ->label('Activo')
                    ->default(false),
                Grid::make()
                    ->schema([
                        Placeholder::make('prev1')
                            ->label('')
                            ->reactive() // sin label para que quede solo la imagen
                            ->content(function ($get) {
                                $id = $get('prod1');
                                // imagen por defecto si no hay producto o imagen
                                $default = asset('imagenes/toolsplaceholder.png');
                                if (! $id) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $p = Inventario::find($id);
                                if (! $p || ! $p->img1) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $path = asset('storage/' . $p->img1);
                                return new HtmlString('<img src="'.$path.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                            })
                            ->columnSpan(1),

                        Select::make('prod1')->label('Producto 1')
                            ->options($productos)->searchable()
                            ->suffixAction(
                                Action::make('editar')
                                    ->label('Editar')
                                    ->icon('heroicon-o-pencil-square')
                                    ->url(fn ($get) => $get('prod1') 
                                        ? route('filament.admin.resources.inventarios.edit', $get('prod1'))
                                        : null
                                    )
                                    ->openUrlInNewTab()
                                    ->disabled(fn ($get) => blank($get('prod1')))
                            )
                            ->reactive()
                            ->preload()
                            ->columnSpan(5),
                    ])
                    ->columns(6),
                Grid::make()
                    ->schema([
                        Placeholder::make('prev2')
                            ->label('')
                            ->reactive() // sin label para que quede solo la imagen
                            ->content(function ($get) {
                                $id = $get('prod2');
                                // imagen por defecto si no hay producto o imagen
                                $default = asset('imagenes/toolsplaceholder.png');
                                if (! $id) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $p = Inventario::find($id);
                                if (! $p || ! $p->img1) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $path = asset('storage/' . $p->img1);
                                return new HtmlString('<img src="'.$path.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                            })
                            ->columnSpan(1),
                            Select::make('prod2')->label('Producto 2')
                            ->options($productos)->searchable()
                            ->suffixAction(
                                Action::make('editar')
                                    ->label('Editar')
                                    ->icon('heroicon-o-pencil-square')
                                    ->url(fn ($get) => $get('prod2') 
                                        ? route('filament.admin.resources.inventarios.edit', $get('prod2'))
                                        : null
                                    )
                                    ->openUrlInNewTab()
                                    ->disabled(fn ($get) => blank($get('prod2')))
                            )
                            ->reactive()
                            ->preload()
                            ->columnSpan(5),
                    ])
                    ->columns(6),
                Grid::make()
                    ->schema([
                        Placeholder::make('prev3')
                            ->label('')
                            ->reactive() // sin label para que quede solo la imagen
                            ->content(function ($get) {
                                $id = $get('prod3');
                                // imagen por defecto si no hay producto o imagen
                                $default = asset('imagenes/toolsplaceholder.png');
                                if (! $id) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $p = Inventario::find($id);
                                if (! $p || ! $p->img1) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $path = asset('storage/' . $p->img1);
                                return new HtmlString('<img src="'.$path.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                            })
                            ->columnSpan(1),
                            Select::make('prod3')->label('Producto 3')
                            ->options($productos)->searchable()
                            ->suffixAction(
                                Action::make('editar')
                                    ->label('Editar')
                                    ->icon('heroicon-o-pencil-square')
                                    ->url(fn ($get) => $get('prod3') 
                                        ? route('filament.admin.resources.inventarios.edit', $get('prod3'))
                                        : null
                                    )
                                    ->openUrlInNewTab()
                                    ->disabled(fn ($get) => blank($get('prod3')))
                            )
                            ->reactive()
                            ->preload()
                            ->columnSpan(5),
                    ])
                    ->columns(6),
                Grid::make()
                    ->schema([
                        Placeholder::make('prev4')
                            ->label('')
                            ->reactive()
                            ->content(function ($get) {
                                $id = $get('prod4');
                                // imagen por defecto si no hay producto o imagen
                                $default = asset('imagenes/toolsplaceholder.png');
                                if (! $id) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $p = Inventario::find($id);
                                if (! $p || ! $p->img1) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $path = asset('storage/' . $p->img1);
                                return new HtmlString('<img src="'.$path.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                            })
                            ->columnSpan(1),
                        Select::make('prod4')->label('Producto 4')
                            ->options($productos)->searchable()
                            ->suffixAction(
                                Action::make('editar')
                                    ->label('Editar')
                                    ->icon('heroicon-o-pencil-square')
                                    ->url(fn ($get) => $get('prod4') 
                                        ? route('filament.admin.resources.inventarios.edit', $get('prod4'))
                                        : null
                                    )
                                    ->openUrlInNewTab()
                                    ->disabled(fn ($get) => blank($get('prod4')))
                            )
                            ->reactive()
                            ->preload()
                            ->columnSpan(5),
                    ])
                    ->columns(6),
                Grid::make()
                    ->schema([
                        Placeholder::make('prev5')
                            ->label('')
                            ->reactive()
                            ->content(function ($get) {
                                $id = $get('prod5');
                                // imagen por defecto si no hay producto o imagen
                                $default = asset('imagenes/toolsplaceholder.png');
                                if (! $id) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $p = Inventario::find($id);
                                if (! $p || ! $p->img1) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $path = asset('storage/' . $p->img1);
                                return new HtmlString('<img src="'.$path.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                            })
                            ->columnSpan(1),
                        Select::make('prod5')->label('Producto 5')
                            ->options($productos)->searchable()
                            ->suffixAction(
                                Action::make('editar')
                                    ->label('Editar')
                                    ->icon('heroicon-o-pencil-square')
                                    ->url(fn ($get) => $get('prod5') 
                                        ? route('filament.admin.resources.inventarios.edit', $get('prod5'))
                                        : null
                                    )
                                    ->openUrlInNewTab()
                                    ->disabled(fn ($get) => blank($get('prod5')))
                            )
                            ->reactive()
                            ->preload()
                            ->columnSpan(5),
                    ])
                    ->columns(6),
                Grid::make()
                    ->schema([
                        Placeholder::make('prev6')
                            ->label('')
                            ->reactive()
                            ->content(function ($get) {
                                $id = $get('prod6');
                                // imagen por defecto si no hay producto o imagen
                                $default = asset('imagenes/toolsplaceholder.png');
                                if (! $id) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $p = Inventario::find($id);
                                if (! $p || ! $p->img1) {
                                    return new HtmlString('<img src="'.$default.'" style="width:64px;height:64px;object-fit:cover;border-radius:8px;">');
                                }
                                $path = asset('storage/' . $p->img1);
                                return new HtmlString('<img src="'.$path.'" style="width:64px;height::64px;object-fit:cover;border-radius:8px;">');
                            })
                            ->columnSpan(1),
                        Select::make('prod6')->label('Producto 6')
                            ->options($productos)->searchable()
                            ->suffixAction(
                                Action::make('editar')
                                    ->label('Editar')
                                    ->icon('heroicon-o-pencil-square')
                                    ->url(fn ($get) => $get('prod6') 
                                        ? route('filament.admin.resources.inventarios.edit', $get('prod6'))
                                        : null
                                    )
                                    ->openUrlInNewTab()
                                    ->disabled(fn ($get) => blank($get('prod6')))
                            )
                            ->reactive()
                            ->preload()
                            ->columnSpan(5),
                    ])
                    ->columns(6),
                
            ]);
    }
}
