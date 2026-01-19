
@php
    $nrocols = 100 / count($data->parametros);
    use App\Models\Inventario;
    $whatsappPhone = $configapp->whatsapp ?? '59179760327';
    $sectionId = 'cards5_' . $data->id; // ID único por sección
@endphp
<div class="section-cards5 slide-up" style="--nrocols: {{$nrocols}}%;">
    <div class="container my-4">
        <div class="row g-3">
            @foreach($data->parametros as $i=>$card)
                @php
                    $productos = Inventario::whereIn('idprod', $card['productos'] ?? [])->get();
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
            @endforeach
        </div>
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
// Almacenar datos por sección
if (!window.cardsDataMap) {
    window.cardsDataMap = {};
}

window.cardsDataMap['{{ $sectionId }}'] = {!! json_encode(collect($data->parametros)->map(function($card, $i) {
    return [
        'index' => $i,
        'texto' => $card['texto'] ?? 'Productos',
        'productos' => Inventario::whereIn('idprod', $card['productos'] ?? [])->get()
    ];
})) !!};


</script>

<style>
/* Modal fijo en viewport */
.section-cards__modal {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: none;
    z-index: 1050;
}

.section-cards__modal.active {
    display: flex;
}

.section-cards__modal-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
}

.section-cards__modal-content {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    max-width: 90vw;
    max-height: 90vh;
    overflow-y: auto;
    border-radius: 8px;
    padding: 20px;
    z-index: 1051;
}
</style>