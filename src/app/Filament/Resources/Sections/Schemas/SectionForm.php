<?php

namespace App\Filament\Resources\Sections\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Placeholder;
use Filament\Actions\Action;
use Illuminate\Support\HtmlString;
use App\Models\Inventario;
use Illuminate\Support\Facades\Log;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Fieldset;
use App\Models\Marca;
use Filament\Forms\Components\RichEditor;
use App\Filament\Resources\Sections\Schemas\SectionTypes\CarouselType;
use App\Filament\Resources\Sections\Schemas\SectionTypes\Cards5Type;
use App\Filament\Resources\Sections\Schemas\SectionTypes\Destacados1Type;
use App\Filament\Resources\Sections\Schemas\SectionTypes\Destacados2Type;
use App\Filament\Resources\Sections\Schemas\SectionTypes\Destacados3Type;
use App\Filament\Resources\Sections\Schemas\SectionTypes\MarcasType;
use App\Filament\Resources\Sections\Schemas\SectionTypes\Lista1Type;


class SectionForm
{
    public static function configure(Schema $schema): Schema
    {
        function generateFormComponent($type)
        {
            return match($type) {
                'carousel' => CarouselType::getSchema(),
                'cards5' => Cards5Type::getSchema(),
                'destacados1' => Destacados1Type::getSchema(),
                'destacados2' => Destacados2Type::getSchema(),
                'destacados3' => Destacados3Type::getSchema(),
                'marcas' => MarcasType::getSchema(),
                'lista1' => Lista1Type::getSchema(),
                default => null,
            };
        }
        return $schema
            ->components([
                Section::make('')
                    ->label('')
                    ->description('')
                    ->schema([
                        Select::make('tipo')
                            ->label('Tipo de sección')
                            ->options([
                                'carousel' => 'Carrusel de Imágenes',
                                'destacados1' => 'Productos Destacados 1',
                                'destacados2' => 'Productos Destacados 2',
                                'destacados3' => 'Imagenes Destacadas',
                                'marcas' => 'Marcas Destacadas',
                                'lista1' => 'Lista de productos de marcas...',
                                'cards5' => 'Cards',
                            ])
                            ->native(false)
                            ->reactive()
                            ->required()
                            ->columnSpan(2),
                        TextInput::make('descripcion')
                            ->columnSpan(4),
                        Select::make('estado')
                            ->options([
                                'activo' => 'Activo',
                                'inactivo' => 'Inactivo',
                            ])
                            ->default('activo')
                            ->native(false)
                            ->required(),
                        TextInput::make('orden')
                            ->numeric()
                            ->required()
                            ->default(0),
                    ])
                    ->columns(8)
                    ->columnSpanFull(),
                
                Section::make('')
                    ->description('')
                        ->schema(function (callable $get) {
                            $type = $get('tipo'); 
                            if (!$type) {
                                return []; 
                            }
                            return [
                                generateFormComponent($type),
                            ];
                    })
                    ->columnSpanFull()
                    ->reactive(),
            ]);
    }
}
