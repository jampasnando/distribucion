
@php
    $whatsappPhone = $configapp->whatsapp ?? '59179760327';
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
                @foreach($data->data as $producto)
                {{-- Producto 1 --}}
                    <div class="col">
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
                @endforeach
            </div> {{-- row derecha --}}
        </div> {{-- col derecha --}}

    </div>
</div>
{{-- <!-- Modal Producto -->
<div class="modal fade" id="productoModal" tabindex="-1" aria-labelledby="productoModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      
      <div class="modal-header">
        <h5 class="modal-title" id="productoModalLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <div class="modal-body">
        <div class="text-center mb-3">
          <img id="productoModalImg" class="img-fluid rounded" style="max-height: 300px; object-fit:cover;">
        </div>

        <p id="productoModalDescripcion"></p>

        <h5 class="fw-bold text-success">Precio: <span id="productoModalPrecio"></span> Bs.</h5>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-success add-cart btn-add-to-cart" id="productoModalAddCartBtn" data-id="{{ $producto->id }}" data-nombre="{{ $producto->descripcion }}" data-precio="{{ $producto->precioventa }}" data-img="{{ $producto->img1 ? asset('storage/'.$producto->img1) : asset('imagenes/toolsplaceholder.png') }}">Añadir al carrito</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div> --}}
<script>
// document.addEventListener("DOMContentLoaded", () => {
//     const modal = new bootstrap.Modal(document.getElementById('productoModal'));

//     document.querySelectorAll(".open-product-modal").forEach(img => {
//         img.addEventListener("click", () => {
//             // Llenar modal
//             document.getElementById("productoModalLabel").textContent = img.dataset.marca;
//             document.getElementById("productoModalImg").src = img.dataset.img;
//             document.getElementById("productoModalDescripcion").textContent = img.dataset.descripcion;
//             document.getElementById("productoModalPrecio").textContent = img.dataset.precio;

//             // Añadir evento al botón agregar carrito
//             const addBtn = document.getElementById("productoModalAddCartBtn");
//             addBtn.setAttribute("data-id", img.dataset.id);
//             addBtn.setAttribute("data-nombre", img.dataset.descripcion);
//             addBtn.setAttribute("data-precio", img.dataset.precio);
//             addBtn.setAttribute("data-img", img.dataset.img);
//             modal.show();
//         });
//     });
// });
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
