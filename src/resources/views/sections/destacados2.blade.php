@php
    $whatsappPhone = $configapp->whatsapp ?? '59179760327';
@endphp
<div class="container my-5 data slide-up border-0 rounded-3" style="padding: 2em;background:{{ $data->parametros['color'] }}">
    <div class="row g-4"> <!-- g-4 da separación entre las dos columnas -->

        <!-- Primera columna -->
        <div class="col-md-6" >
            <div class="p-4 h-100 border-0 rounded-3 shadow-sm" style="background: {{ $data->parametros['bgcolorX'] }}">
                <div class="{{ $data->parametros['titulofontX'] }} {{ $data->parametros['tamtituloX'] }} mb-3"
                    style="color:{{ $data->parametros['colorletraX'] ?? '' }}">{{ $data->parametros['titulox'] }}
                </div>
                <div class="row g-3">
                    @foreach ($data->data as $index => $unprods2x)
                        @if ($index < 4)
                            <div class="col-6">
                                <div class="card product-card h-100">
                                    <img src="{{ $unprods2x->img1 ? asset('storage/' . $unprods2x->img1) : asset('imagenes/toolsplaceholder.png') }}"
                                        class="card-img-top open-product-modal" alt="Taladro" style="object-fit:cover;"
                                        data-id="{{ $unprods2x->id }}"
                                        data-marca="{{ $unprods2x->marca }}"
                                        data-descripcion="{{ $unprods2x->descripcion }}"
                                        data-precio="{{ $unprods2x->precioventa }}"
                                        data-img="{{ $unprods2x->img1 ? asset('storage/'.$unprods2x->img1) : asset('imagenes/toolsplaceholder.png') }}"
                                        >
                                    <div class="card-body d-flex flex-column p-2">
                                        <h6 class="card-title mb-1">{{ $unprods2x->marca }}</h6>
                                        <p class="card-text text-truncate mb-2 small">{{ $unprods2x->descripcion }}</p>
                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <span
                                                class="fw-bold text-secondary small">Bs.{{ $unprods2x->precioventa }}</span>
                                            <span>
                                                <a href="https://wa.me/{{$whatsappPhone}}?text=Consulta%20por%20producto:%20{{ urlencode($unprods2x->idprod) }}" target="_blank" class="btn btn-sm btn-outline-success add-cart">
                                                    <i class="bi bi-whatsapp"></i>
                                                </a>
                                                <button class="btn btn-success btn-sm add-cart btn-add-to-cart"
                                                    data-id="{{ $unprods2x->id }}"
                                                    data-nombre="{{ $unprods2x->descripcion }}"
                                                    data-precio="{{ $unprods2x->precioventa }}"
                                                    data-img="{{ $unprods2x->img1 ? asset('storage/'.$unprods2x->img1) : asset('imagenes/toolsplaceholder.png') }}"
                                                    >Añadir</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Segunda columna -->
        <div class="col-md-6">
            <div class="p-4 h-100 border-0 rounded-3 shadow-sm" style="background: {{ $data->parametros['bgcolorY'] }}">
                <div class="{{ $data->parametros['titulofontY'] }} {{ $data->parametros['tamtituloY'] }} mb-3"
                    style="color:{{ $data->parametros['colorletraY'] ?? '' }}">{{ $data->parametros['tituloY'] }}
                </div>
                <div class="row g-3">
                    @foreach ($data->data as $index => $unprods2y)
                        @if ($index > 3)
                            <div class="col-6">
                                <div class="card product-card h-100">
                                    <img src="{{ $unprods2y->img1 ? asset('storage/' . $unprods2y->img1) : asset('imagenes/toolsplaceholder.png') }}"
                                        class="card-img-top open-product-modal" alt="Taladro" style="height:150px; object-fit:cover;"
                                        data-id="{{ $unprods2y->id }}"
                                        data-marca="{{ $unprods2y->marca }}"
                                        data-descripcion="{{ $unprods2y->descripcion }}"
                                        data-precio="{{ $unprods2y->precioventa }}"
                                        data-img="{{ $unprods2y->img1 ? asset('storage/'.$unprods2y->img1) : asset('imagenes/toolsplaceholder.png') }}"    
                                    >
                                    <div class="card-body d-flex flex-column p-2">
                                        <h6 class="card-title mb-1">{{ $unprods2y->marca }}</h6>
                                        <p class="card-text text-truncate mb-2 small">{{ $unprods2y->descripcion }}</p>
                                        <div class="mt-auto d-flex justify-content-between align-items-center">
                                            <span
                                                class="fw-bold text-secondary small">Bs.{{ $unprods2y->precioventa }}</span>
                                            <span>
                                                <a href="https://wa.me/{{$whatsappPhone}}?text=Consulta%20por%20producto:%20{{ urlencode($unprods2y->idprod) }}" target="_blank" class="btn btn-sm btn-outline-success add-cart">
                                                    <i class="bi bi-whatsapp"></i>
                                                </a>
                                                <button class="btn btn-success btn-sm add-cart btn-add-to-cart"
                                                    data-id="{{ $unprods2y->id }}"
                                                    data-nombre="{{ $unprods2y->descripcion }}"
                                                    data-precio="{{ $unprods2y->precioventa }}"
                                                    data-img="{{ $unprods2y->img1 ? asset('storage/'.$unprods2y->img1) : asset('imagenes/toolsplaceholder.png') }}"
                                                    >Añadir</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</div>
