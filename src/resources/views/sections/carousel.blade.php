<div class="row">
  <!-- Carrusel de imágenes -->
  @php
    // dd($data->parametros)    
  @endphp
  <div class="col-md-12">
    <div id="marketCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-inner">
        @foreach($data->parametros as $index => $carrusel)
        <div class="carousel-item @if($index == 0) active @endif">
          <img src="{{ asset('storage/' . $carrusel['unaimagen']) }}" class="d-block w-100 banner-img" alt="Carrusel {{ $index + 1 }}">
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
{{-- <style>
    .carousel {
        display: flex;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
    }
    .carousel img {
        flex: 0 0 auto;
        width: 100%;
        height: auto;
        scroll-snap-align: start;
    }
</style> --}}