@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')

<style>
.banner-img {
    height: 300px;        /* altura deseada tipo banner */
    object-fit: cover;    /* mantiene la proporción y corta lo que sobra */
}
</style>  
<div class="row">
  <!-- Menú lateral izquierdo -->
  {{-- <div class="col-md-3 mb-4">
    <div class="list-group">
      <a href="#" class="list-group-item list-group-item-action">Carpintería</a>
      <a href="#" class="list-group-item list-group-item-action">Cerrajería</a>
      <a href="#" class="list-group-item list-group-item-action">Jardinería</a>
      <a href="#" class="list-group-item list-group-item-action">Herramientas</a>
    </div>
  </div> --}}
  <!-- Carrusel de imágenes -->
  <div class="col-md-12">
    <div id="marketCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="{{asset('imagenes/variasherramientas.png')}}" class="d-block w-100 banner-img" alt="Carpintería">
        </div>
        <div class="carousel-item">
          <img src="{{asset('imagenes/drill.jpg')}}" class="d-block w-100 banner-img" alt="Cerrajería">
        </div>
        <div class="carousel-item">
          <img src="{{asset('imagenes/llaveinglesa.png')}}" class="d-block w-100 banner-img" alt="Jardinería">
        </div>
        <div class="carousel-item">
          <img src="{{asset('imagenes/drill.jpg')}}" class="d-block w-100 banner-img" alt="Herramientas">
        </div>
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
@endsection