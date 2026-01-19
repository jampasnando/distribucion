@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')

<style>
.banner-img {
    height: 300px;        /* altura deseada tipo banner */
    object-fit: cover;    /* mantiene la proporción y corta lo que sobra */
}
.product-card {
    border: 1px solid #eee;
    border-radius: 10px;
    transition: transform 0.3s, box-shadow 0.3s;
    overflow: hidden;
    cursor: pointer;
}

.product-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
}

.product-card .add-cart {
    opacity: 0;
    transition: opacity 0.3s;
}

.product-card:hover .add-cart {
    opacity: 1;
}

/* Texto más compacto y atractivo */
.card-title {
    font-size: 0.9rem;
}
.card-text {
    font-size: 0.75rem;
    color: #555;
}
.featured-img-wrapper {
    overflow: hidden;              /* evita que se vea fuera del borde */
    border-radius: 12px;           /* bordes redondeados */
    aspect-ratio: 3/4;             /* relación de aspecto 3:4 */
    width: 100%;

}

.featured-img {
    width: 100%;
    height: 100%;
    object-fit: cover;             /* recorta sin deformar */
    transition: transform 0.4s ease, box-shadow 0.4s ease;
    border-radius: 12px;
}

.featured-img-wrapper:hover .featured-img {
    transform: scale(1.08);        /* pequeño zoom */
    box-shadow: 0 10px 20px rgba(0,0,0,0.25); /* sombra elegante */
}
.destacado2s{
      background: whitesmoke;
    padding: 2em;
    border-radius: 25px;
}
/* @keyframes slide-up {
  0% {
    transform: translateY(50px);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}

.animate-slide-up {
  animation: slide-up 0.8s ease-out forwards;
} */
@keyframes slide-up {
  0% {
    transform: translateY(50px);
    opacity: 0;
  }
  100% {
    transform: translateY(0);
    opacity: 1;
  }
}

.slide-up {
  opacity: 0;
  transform: translateY(50px);
  transition: all 0.8s ease-out;
}

.slide-up.show {
  animation: slide-up 0.8s ease-out forwards;
}


.logo-slider {
  overflow: hidden;
  position: relative;
  /* width: 100%; */
  background: #fff;
  padding: 20px 0;
}

.logo-track {
  display: flex;
  width: calc(250px * 12); /* ancho = logo ancho * cantidad */
  animation: scroll 30s linear infinite;
}

.logo-track img {
  /* width: 250px; */
  height: 6em;
  margin: 0 20px;
  filter: grayscale(100%);
  transition: filter 0.3s ease;
}

.logo-track img:hover {
  filter: grayscale(0%);
}

@keyframes scroll {
  from {
    transform: translateX(0);
  }
  to {
    transform: translateX(-50%);
  }
}
</style>  
<div class="row">
  <!-- Carrusel de imágenes -->
  <div class="col-md-12">
    <div id="marketCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($carruseles as $index => $carrusel)
        <div class="carousel-item @if($index == 0) active @endif">
          <img src="{{ asset('storage/' . $carrusel->imagen) }}" class="d-block w-100 banner-img" alt="Carrusel {{ $index + 1 }}">
        </div>
        @endforeach
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#marketCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon"></span>
        <span class="visually-hidden">Anterior</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#marketCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon"></span>
        <span class="visually-hidden">Siguiente</span>
      </button>
    </div>
  </div>
</div>

<div class="container my-3 slide-up">
    <h3 class="w-100 text-center py-3">{{$destacados->titulo}}</h3>
    <div class="row g-4 align-items-start">

        {{-- Izquierda: imagen 3:4 --}}
        <div class="col-12 col-lg-4">
            <div class="featured-img-wrapper"><img src="{{asset('storage/'.$imagen_destacada)}}" alt="Destacado" class="img-fluid rounded featured-img" style="aspect-ratio: 3/4; width: 100%;"></div>
        </div>

        {{-- Derecha: grid de productos --}}
        <div class="col-12 col-lg-8">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($productos as $producto)
                {{-- Producto 1 --}}
                    <div class="col">
                        <div class="card product-card h-100 rounded">
                            <img src="{{asset('storage/'.$producto->img1)}}" class="card-img-top" alt="Producto 1" style="object-fit:cover;">
                            <div class="card-body d-flex flex-column p-2">
                                <h6 class="card-title mb-1">{{$producto->marca}}</h6>
                                <p class="card-text text-truncate mb-2 small">{{$producto->descripcion}}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-secondary small">Bs.{{$producto->precioventa}}</span>
                                    <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="{{ $producto->id }}" data-nombre="{{ $producto->descripcion }}" data-precio="{{ $producto->precioventa }}">Añadir</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> {{-- row derecha --}}
        </div> {{-- col derecha --}}

    </div>
</div>

{{-- carrusel de logos de marcas --}}
<div class="container logo-slider slide-up">
    <h3>Marcas de la mejor calidad</h3>
  <div class="logo-track">
    @foreach($logos as $logo)
      <img src="{{ asset('storage/' . $logo->logo) }}" alt="{{ $logo->nombre }}">
    @endforeach
    @foreach($logos as $logo)
      <img src="{{ asset('storage/' . $logo->logo) }}" alt="{{ $logo->nombre }}">
    @endforeach
    @foreach($logos as $logo)
      <img src="{{ asset('storage/' . $logo->logo) }}" alt="{{ $logo->nombre }}">
    @endforeach
  </div>
</div>

{{-- destacados2 --}}
<div class="container my-5 destacado2s slide-up" style="padding: 2em;border-radious:20px;background:{{$destacado2s->color}}">
    <div class="row g-4"> <!-- g-4 da separación entre las dos columnas -->
        
        <!-- Primera columna -->
        <div class="col-md-6">
            <div class="p-4 h-100 bg-light border rounded-3 shadow-sm">
                <h3 class="mb-3">{{$destacado2s->titulox}}</h3>
                <div class="row g-3">
                      @foreach ($prods2x as $unprods2x)
                        <div class="col-6">
                          <div class="card product-card h-100">
                            <img src="{{$unprods2x->img1 ? asset('storage/'.$unprods2x->img1) : asset('imagenes/toolsplaceholder.png')}}" class="card-img-top" alt="Taladro" style="object-fit:cover;">
                            <div class="card-body d-flex flex-column p-2">
                                <h6 class="card-title mb-1">{{$unprods2x->marca}}</h6>
                                <p class="card-text text-truncate mb-2 small">{{$unprods2x->descripcion}}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-secondary small">Bs.{{$unprods2x->precioventa}}</span>
                                    <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="{{ $unprods2x->id }}" data-nombre="{{ $unprods2x->descripcion }}" data-precio="{{ $unprods2x->precioventa }}">Añadir</button>
                                </div>
                            </div>
                          </div>
                        </div>
                       @endforeach

                </div>
            </div>
        </div>

        <!-- Segunda columna -->
        <div class="col-md-6">
            <div class="p-4 h-100 bg-light border rounded-3 shadow-sm">
                <h3 class="mb-3">{{$destacado2s->tituloy}}</h3>
                <div class="row g-3">
                     @foreach ($prods2y as $unprods2y)
                        <div class="col-6">
                          <div class="card product-card h-100">
                            <img src="{{$unprods2y->img1 ? asset('storage/'.$unprods2y->img1) : asset('imagenes/toolsplaceholder.png')}}" class="card-img-top" alt="Taladro" style="height:150px; object-fit:cover;">
                            <div class="card-body d-flex flex-column p-2">
                                <h6 class="card-title mb-1">{{$unprods2y->marca}}</h6>
                                <p class="card-text text-truncate mb-2 small">{{$unprods2y->descripcion}}</p>
                                <div class="mt-auto d-flex justify-content-between align-items-center">
                                    <span class="fw-bold text-secondary small">Bs.{{$unprods2y->precioventa}}</span>
                                    <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="{{ $unprods2y->id }}" data-nombre="{{ $unprods2y->descripcion }}" data-precio="{{ $unprods2y->precioventa }}">Añadir</button>
                                </div>
                            </div>
                          </div>
                        </div>
                       @endforeach
                </div>
            </div>
        </div>

    </div>
</div>



{{-- Listas dinámicas --}}

@foreach ($listas as $lista)
<div class="container mt-4 slide-up">
    <h3>{{$lista->titulo}}</h3>
    <div class="row justify-content-left g-4">
        @forEach($lista->productosPaginados() as $unproductolista)
            {{-- Producto 1 --}}
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card product-card h-100">
                    <img src="{{$unproductolista->img1 ? asset('storage/'.$unproductolista->img1) : asset('imagenes/toolsplaceholder.png')}}" class="card-img-top" alt="Taladro" style="height:150px; object-fit:cover;">
                    <div class="card-body d-flex flex-column p-2">
                        <h6 class="card-title mb-1">{{$unproductolista->marca}}</h6>
                        <p class="card-text text-truncate mb-2 small">{{$unproductolista->descripcion}}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-secondary small">Bs.{{$unproductolista->precioventa}}</span>
                            <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="{{ $producto->id }}" data-nombre="{{ $producto->descripcion }}" data-precio="{{ $producto->precioventa }}">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforEach
         {{-- Paginación independiente usando el límite de la lista --}}
        <div class="mt-3">
            {{ $lista->productosPaginados()->links() }}
        </div>
        </div>
</div>
@endforeach
{{-- <div class="container mt-4 slide-up">
    <h3>Cerrajería</h3>
    <div class="row justify-content-center g-4">
        @forEach($productos as $producto)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card product-card h-100">
                    <img src="{{asset('storage/'.$producto->img1)}}" class="card-img-top" alt="Taladro" style="height:150px; object-fit:cover;">
                    <div class="card-body d-flex flex-column p-2">
                        <h6 class="card-title mb-1">{{$producto->marca}}</h6>
                        <p class="card-text text-truncate mb-2 small">{{$producto->descripcion}}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-secondary small">Bs.{{$producto->precioventa}}</span>
                            <button class="btn btn-success btn-sm add-cart">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforEach
    </div>
</div>
<div class="container mt-4 slide-up">
    <h3>Carpintería</h3>
    <div class="row justify-content-center g-4">
        @forEach($productos as $producto)
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card product-card h-100">
                    <img src="{{asset('storage/'.$producto->img1)}}" class="card-img-top" alt="Taladro" style="height:150px; object-fit:cover;">
                    <div class="card-body d-flex flex-column p-2">
                        <h6 class="card-title mb-1">{{$producto->marca}}</h6>
                        <p class="card-text text-truncate mb-2 small">{{$producto->descripcion}}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-secondary small">Bs.{{$producto->precioventa}}</span>
                            <button class="btn btn-success btn-sm add-cart">Añadir</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforEach
    </div>
</div> --}}

@endsection
