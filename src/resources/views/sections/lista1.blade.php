@php
    $whatsappPhone = $configapp->whatsapp ?? '59179760327';
@endphp
<div class="container mt-4 slide-up" id="lista{{$data->id}}">
    <h3>{{$data->parametros['titulo']}}</h3>
    <div class="row justify-content-left g-4">
        @foreach($data->data as $unproductolista)
            {{-- Producto 1 --}}
            <div class="col-6 col-sm-4 col-md-3 col-lg-2-4">
                <div class="card product-card h-100 rounded">
                    <img 
                        src="{{$unproductolista->img1 ? asset('storage/'.$unproductolista->img1) : asset('imagenes/toolsplaceholder.png')}}"
                        class="card-img-top open-product-modal"
                        alt="unProductolista"
                        style="object-fit:cover; cursor:pointer;"
                        data-id="{{ $unproductolista->id }}"
                        data-marca="{{ $unproductolista->marca }}"
                        data-descripcion="{{ $unproductolista->descripcion }}"
                        data-precio="{{ $unproductolista->precioventa }}"
                        data-img="{{ $unproductolista->img1 ? asset('storage/'.$unproductolista->img1) : asset('imagenes/toolsplaceholder.png') }}"
                    >
                    <div class="card-body d-flex flex-column p-2">
                        <h6 class="card-title mb-1">{{$unproductolista->marca}}</h6>
                        <p class="card-text text-truncate mb-2 small">{{$unproductolista->descripcion}}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-secondary small">Bs.{{$unproductolista->precioventa}}</span>
                            <span>
                                <a href="https://wa.me/{{$whatsappPhone}}?text=Consulta%20por%20producto:%20{{ urlencode($unproductolista->idprod) }}" target="_blank" class="btn btn-sm btn-outline-success add-cart">
                                            <i class="bi bi-whatsapp"></i>
                                </a>
                                <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="{{ $unproductolista->id }}" data-nombre="{{ $unproductolista->descripcion }}" data-precio="{{ $unproductolista->precioventa }}" data-img="{{ $unproductolista->img1 ? asset('storage/'.$unproductolista->img1) : asset('imagenes/toolsplaceholder.png') }}">Añadir</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
         {{-- Paginación independiente usando el límite de la lista --}}
        <div class="mt-3" style="border-bottom: 1px solid #ddd; padding-bottom: 5px;">
            {{ $data->data->appends(request()->query())->fragment('lista'.$data->id)->links() }}
        </div>
        </div>
</div>
<style>
@media (min-width: 992px) {
        .col-lg-2-4 {
            flex: 0 0 20%;
            max-width: 20%;
        }
}

.pagination .page-link {
    transition: all 0.2s ease-in-out;
    font-size: 0.8rem;
    padding: 6px 10px;
    color: gray;
}

.pagination .page-link:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    
}

.pagination .active .page-link {
    font-weight: bold;
    transform: scale(1.1);
    background: lightgreen;
}
.pagination .disabled .page-link {
    color: #ccc;
    pointer-events: none;
}

</style>