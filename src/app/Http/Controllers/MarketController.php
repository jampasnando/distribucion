<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrusel;
use App\Models\Destacado;
use App\Models\Inventario;
use App\Models\Lista;
use App\Models\Marca;
use Illuminate\Support\Facades\Log;
use App\Models\Destacado2;
use App\Models\Section;
use App\Models\Configapp;

class MarketController extends Controller
{
    public function obtenerSections()
    {
        $sections = Section::where('estado','activo')->orderBy('orden')->get();

        // Si necesitas enriquecer algunos tipos de secciones
        $sections->transform(function ($section) {
            if ($section->tipo === 'destacados2') {
                $section->data = Inventario::whereIn('id', $section->parametros)->get();
            }
            if ($section->tipo === 'destacados1') {
                $section->data = Inventario::whereIn('id', $section->parametros['imagenes'])->get();
                // dd($section);
            }
            if ($section->tipo === 'marcas') {
                $section->data = Marca::whereIn('id', $section->parametros['imagenes'])->get();
                // dd($section);
            }
            if ($section->tipo === 'cards5') {
                // $section->data = Marca::whereIn('id', $section->parametros['imagenes'])->get();
                // dd($section);
            }
            if ($section->tipo ==='lista1')
            {
                $parametros = $section->parametros;
                $conimagenes = $parametros['conimagenes'];
                $categorias = collect($parametros['categorias'])
                                ->pluck('categoria')
                                ->toArray();
                // Obtener marcas en array simple
                $marcas = collect($parametros['marcas'])
                            ->pluck('marca')
                            ->toArray();

                // Consultar inventario
                if($conimagenes){
                    if(count($categorias)>0){
                        $productos = Inventario::whereIn('marca', $marcas)->whereNot('img1',NULL)->whereIn('categoria',$categorias)->paginate(10);
                    }
                    else{
                        $productos = Inventario::whereIn('marca', $marcas)->whereNot('img1',NULL)->paginate(10);
                    }
                }
                else{
                    if(count($categorias)>0){

                        $productos = Inventario::whereIn('marca', $marcas)->whereIn('categoria',$categorias)->paginate(10);
                    }
                    else{
                        $productos = Inventario::whereIn('marca', $marcas)->paginate(10);
                    }
                }
                $section->data = $productos;
            }
            return $section;
        });
        return $sections;
    }
    public function index(Request $request)
    {
        $sections = $this->obtenerSections();
        $configapp = Configapp::first();

        if($request->has('buscar')){
            $buscar = $request->input('buscar');
            // Realiza la búsqueda en el modelo Inventario
            $productos = Inventario::where('descripcion', 'LIKE', "%{$buscar}%")
                ->orWhere('marca', 'LIKE', "%{$buscar}%")
                ->orWhere('categoria', 'LIKE', "%{$buscar}%")->limit(50)
                ->paginate(24)
                ->appends(['buscar' => $buscar]);
            // Crear una sección temporal con los resultados y colocarla en la posición 1
            // $searchSection = Section::make([
            //     'tipo' => 'busqueda',
            //     'titulo' => "Resultados para: {$buscar}",
            //     'parametros' => [],
            //     'data' => $productos,
            // ]);
            $searchSection = (object)[
                'tipo' => 'busqueda',
                'titulo' => "Resultados para: {$buscar}",
                'parametros' => [],
                'data' => $productos,
            ];
            // dd($searchSection);
            // Inserta en índice 1 (segundo elemento). Usa 0 si quieres que sea el primero.
            $sections->splice(1, 0, [$searchSection]);
        }
        

        return view('market.index', compact('sections', 'configapp'));
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function buscar(Request $request)
    {
        $buscar = $request->input('buscar');

        // Realiza la búsqueda en el modelo Inventario
        $buscados = Inventario::where('descripcion', 'LIKE', "%{$buscar}%")
            ->orWhere('marca', 'LIKE', "%{$buscar}%")
            ->orWhere('categoria', 'LIKE', "%{$buscar}%")->limit(50)
            ->paginate(24)
            ->appends(['buscar' => $buscar]);

        // Retorna la vista con los resultados de la búsqueda
        $carruseles = Carrusel::orderBy('orden')->get();
        $logos = Marca::where('carrusel', true)->get();
        $configapp = Configapp::first();
        $productos=[];
        return view('market.resultadobusqueda', compact('productos','buscados','carruseles', 'logos', 'buscar', 'configapp'));
    }   
    
}
