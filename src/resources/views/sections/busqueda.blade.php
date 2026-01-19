@php
    $productos = $section->data;
    $buscar = $section->titulo;
@endphp
<div class="container mt-4 slide-up" id="seccionbusqueda">
    <h3>Resultados de buscar: {{$buscar}}</h3>
    <div class="row justify-content-center g-4">
        @forEach($productos as $producto)
            {{-- Producto 1 --}}
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card product-card h-100">
                    <img src="{{$producto->img1 ? asset('storage/'.$producto->img1) : asset('imagenes/toolsplaceholder.png')}}" class="card-img-top" alt="Taladro" style="height:150px; object-fit:cover;">
                    <div class="card-body d-flex flex-column p-2">
                        <h6 class="card-title mb-1">{{$producto->marca}}</h6>
                        <p class="card-text text-truncate mb-2 small">{{$producto->descripcion}}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-secondary small">Bs.{{$producto->precioventa}}</span>
                            <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="{{ $producto->id }}" data-nombre="{{ $producto->descripcion }}" data-precio="{{ $producto->precioventa }}"data-img="{{ $producto->img1 ? asset('storage/'.$producto->img1) : asset('imagenes/toolsplaceholder.png') }}">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforEach
    </div>
    {{-- Links de paginación --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $productos->links() }}
    </div>
</div>