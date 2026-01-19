@php
    use App\Models\Inventario;
    // $nrocols = 100 / count($data->parametros);
    $whatsappPhone = $configapp->whatsapp ?? '59179760327';
    $sectionId = 'cards5_' . $data->id;
@endphp
<div class="container my-3 slide-up" style="background-color:{{$data->parametros['bgcolor']??'transparent'}}; padding:15px; border-radius:8px;">
    <div class="{{$data->parametros['titulofont']}} {{$data->parametros['titulosize']}} w-100 text-center py-3" style="color:{{$data->parametros['titulocolor']??''}}">{{$data->parametros['titulo']}}</div>
    <div class="row g-4 align-items-start">

        {{-- Izquierda: imagen 3:4 --}}
        <div class="col-12 col-lg-4">
            <div class="featured-img-wrapper"><img src="{{asset('storage/'.$data->parametros['imagen_destacada'])}}" alt="Destacado" class="img-fluid rounded featured-img" style="aspect-ratio: 3/4; width: 100%;"></div>
        </div>

        {{-- Derecha: grid de productos --}}
        <div class="col-12 col-lg-8">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @foreach($data->parametros['cards'] as $i=>$card)
                @php
                    $productos = Inventario::whereIn('idprod', $card['productos'] ?? [])->get();
                    $modalId = 'modal-card-' . ($i+100);
                @endphp
                <div class="col-12 col-sm-6 col-md-4 col-lg-2-custom">
                    <div class="section-cards5__card h-100" onclick="openCardModal('{{ $sectionId }}', {{ $i }}, {{ json_encode($card['texto'] ?? '') }})" style="cursor:pointer;">
                        
                        <img
                            src="{{ asset('storage/' . $card['imagen']) }}"
                            class="section-cards5__img"
                            alt="Imagen card"
                        >
                        @if(!empty($card['texto']))
                            <div class="section-cards5__body">
                                <p class="section-cards5__text">
                                    {{ $card['texto'] }}
                                </p>
                            </div>
                        @endif

                    </div>
                </div>
                {{-- MODAL --}}
                <div class="section-cards__modal" id="{{ $modalId }}">
                    <div class="section-cards__modal-backdrop" onclick="closeCardModal('{{ $modalId }}')"></div>

                    <div class="section-cards__modal-content">
                        <button class="section-cards__modal-close" onclick="closeCardModal('{{ $modalId }}')">
                            ×
                        </button>

                        <h3 class="section-cards__modal-title">
                            {{ $card['texto'] ?? 'Productos' }}
                        </h3>

                        <div class="section-cards__products-grid">
                            @forelse($productos as $producto)
                                <div class="section-cards__product">
                                    <div class="card product-card h-100 rounded">
                                        <img 
                                            src="{{$producto->img1 ? asset('storage/'.$producto->img1) : asset('imagenes/toolsplaceholder.png')}}"
                                            class="card-img-top open-product-modal"
                                            alt="Producto"
                                            style="object-fit:cover; cursor:pointer;"
                                            data-id="{{ $producto->id }}"
                                            data-marca="{{ $producto->marca }}"
                                            data-descripcion="{{ $producto->descripcion }}"
                                            data-precio="{{ $producto->precioventa }}"
                                            data-img="{{ $producto->img1 ? asset('storage/'.$producto->img1) : asset('imagenes/toolsplaceholder.png') }}"
                                        >
                                        <div class="card-body d-flex flex-column p-2">
                                            <h6 class="card-title mb-1">{{$producto->marca}}</h6>
                                            <p class="card-text text-truncate mb-2 small">{{$producto->descripcion}}</p>
                                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                                <span class="fw-bold text-secondary small">Bs.{{$producto->precioventa}}</span>
                                                <span>
                                                    <a href="https://wa.me/{{$whatsappPhone}}?text=Consulta%20por%20producto:%20{{ urlencode($producto->idprod) }}" target="_blank" class="btn btn-sm btn-outline-success add-cart">
                                                        <i class="bi bi-whatsapp"></i>
                                                    </a>
                                                    <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="{{ $producto->id }}" data-nombre="{{ $producto->descripcion }}" data-precio="{{ $producto->precioventa }}" data-img="{{ $producto->img1 ? asset('storage/'.$producto->img1) : asset('imagenes/toolsplaceholder.png') }}">Añadir</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p class="section-cards__empty">No hay productos</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endforeach
            </div> {{-- row derecha --}}
        </div> {{-- col derecha --}}

    </div>
</div>

<!-- MODAL DINÁMICO ÚNICO POR SECCIÓN -->
<div class="section-cards__modal" id="modalProductos_{{ $sectionId }}">
    <div class="section-cards__modal-backdrop" onclick="closeCardModal('{{ $sectionId }}')"></div>
    <div class="section-cards__modal-content">
        <button class="section-cards__modal-close" onclick="closeCardModal('{{ $sectionId }}')">×</button>
        <h3 class="section-cards__modal-title" id="modalTitulo_{{ $sectionId }}"></h3>
        <div class="section-cards__products-grid" id="modalProductosGrid_{{ $sectionId }}"></div>
    </div>
</div>

<script>
    if (!window.cardsDataMap) {
    window.cardsDataMap = {};
}

window.cardsDataMap['{{ $sectionId }}'] = {!! json_encode(collect($data->parametros['cards'])->map(function($card, $i) {
    return [
        'index' => $i,
        'texto' => $card['texto'] ?? 'Productos',
        'productos' => Inventario::whereIn('idprod', $card['productos'] ?? [])->get()
    ];
})) !!};
document.addEventListener('hidden.bs.modal', function (event) {
    // Eliminar todos los backdrops que queden
    document.querySelectorAll('.modal-backdrop').forEach(function(el){
        el.remove();
    });

    // Restaurar scroll y clases
    document.body.classList.remove('modal-open');
    document.body.style.overflow = '';
});
</script>
