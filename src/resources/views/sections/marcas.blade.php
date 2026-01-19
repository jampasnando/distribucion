<div class="container logo-slider slide-up">
    <h3 class="w-100 text-center py-3">{{$data->parametros['titulo']}}</h3>
  <div class="logo-track">
    @foreach($data->data as $marca)
      <img src="{{ asset('storage/' . $marca->logo) }}" alt="{{ $marca->nombre }}">
    @endforeach
    @foreach($data->data as $marca)
      <img src="{{ asset('storage/' . $marca->logo) }}" alt="{{ $marca->nombre }}">
    @endforeach
    @foreach($data->data as $marca)
      <img src="{{ asset('storage/' . $marca->logo) }}" alt="{{ $marca->nombre }}">
    @endforeach
  </div>
</div>