
@php
  $latitud = $configapp->latitud ?? 0; // Valor por defecto Cochabamba
  $longitud = $configapp->longitud ?? 0; //
@endphp
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="{{ asset('storage/images/logo.png') }}">
  <title>@yield('title', 'Mi Proyecto Laravel')</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
  
  <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    .icon-btn {
      background: none;
      border: none;
      font-size: 1.25rem;
      margin-left: 10px;
    }
    .geo-btn {
    color: red;                     /* color del icono */
    font-size: 1.5rem;              /* tamaño del icono */
    padding: 8px;                   /* espacio dentro del círculo */
    border-radius: 50%;             /* círculo */
    transition: all 0.3s ease;      /* transición suave */
    cursor: pointer;                /* puntero al pasar el mouse */
}

/* Hover */
.geo-btn:hover {
    background-color: rgba(255,0,0,0.1); /* fondo circular rojo suave */
    box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* sombra sutil */
    transform: scale(1.2);                  /* pequeño zoom */
}
.banner-img {
    height: auto;        altura deseada tipo banner
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
  /* filter: grayscale(100%); */
  /* transition: filter 0.3s ease; */
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
.whatsapp-btn {
    position: fixed;
    right: 0;
    top: 50%;
    transform: translateY(-50%);
    z-index: 9999;
    background: white;
    padding: 8px;
    border-radius: 50%;
    box-shadow: 0 2px 8px rgba(0,0,0,0.3);
}

.whatsapp-btn img {
    width: 45px;
    height: 45px;
    object-fit: contain;
}

/* Ajustes en pantallas pequeñas (evitar tap targets fuera de pantalla) */
@media (max-width: 420px) {
  .whatsapp-float {
    width: 48px;
    height: 48px;
    margin-right: 6px;
    border-radius: 24px 0 0 24px;
  }
  .whatsapp-float svg { width: 24px; height: 24px; }
}
.social-icon {
    width: 24px;
    height: 24px;
    object-fit: contain;
    display: block;
}
.icon-btn svg {
    width: 24px;
    height: 24px;
    display: block;
    stroke: #6c757d;   /* gris */
    stroke-width: 2;
    fill: transparent; /* borde solamente */
    transition: 0.25s ease;
}

.icon-btn:hover svg {
    fill: #6c757d !important; /* se rellena en hover */
    stroke: none;
}
.footer-map {
    background: #f2f2f2;
    color: #444;
}

.footer-title {
    font-weight: 600;
    margin-bottom: 10px;
    color: #222;
}

.footer-text {
    font-size: 14px;
    line-height: 1.6;
}

#map-footer {
    height: 180px;
    border-radius: 8px;
    overflow: hidden;
}

.social-links a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    margin-right: 10px;
    background: gray;
    border-radius: 50%;
    color: lightgray;
    font-size: 18px;
    transition: all 0.3s ease;
}

.social-links a:hover {
    background: lightgray;
    color: grey;
}

.footer-divider {
    margin: 25px 0 15px;
}

.footer-copy {
    font-size: 13px;
    color: #777;
}
/* CONTENEDOR RAÍZ */
.section-cards5 {
    width: 100%;
}

/* CARD */
.section-cards5__card {
    background: #ffffff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.08);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
}

/* IMAGEN */
.section-cards5__img {
    width: 100%;
    height: auto;
    display: block;
}

/* CUERPO */
.section-cards5__body {
    padding: 0.75rem;
    flex-grow: 1;
    display: flex;
    align-items: center;
    justify-content: center;
}

/* TEXTO */
.section-cards5__text {
    margin: 0;
    font-size: 0.9rem;
    text-align: center;
    color: #333;
}

/* SOLO ESTA SECTION → 5 COLUMNAS */
@media (min-width: 992px) {
    .section-cards5 .col-lg-2-custom {
        flex: 0 0 var(--nrocols);
        max-width: var(--nrocols);
    }
}
@media (min-width: 992px) {
    .section-cards4 .col-lg-2-custom {
        flex: 0 0 25%;
        max-width: 25%;
    }
}
.section-cards5__card {
    transition: 
        transform 0.35s cubic-bezier(.4,0,.2,1),
        box-shadow 0.35s cubic-bezier(.4,0,.2,1);
    cursor: pointer;
}

/* HOVER / TOUCH */
.section-cards5__card:hover,
.section-cards5__card:focus-within {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0, 0, 0, 0.15);
}

/* ZOOM SUAVE DE LA IMAGEN */
.section-cards5__img {
    transition: transform 0.5s ease;
}

.section-cards5__card:hover .section-cards5__img,
.section-cards5__card:focus-within .section-cards5__img {
    transform: scale(1.05);
}

/* TEXTO MÁS VISIBLE AL HOVER */
.section-cards5__card:hover .section-cards5__text {
    color: #111;
}
/* ===== MODAL ===== */
/* .section-cards__modal {
    inset: 0;
    z-index: 5000;
    display: none;
}

.section-cards__modal.active {
    display: block;
}

.section-cards__modal-backdrop {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.55);
    backdrop-filter: blur(4px);
}

.section-cards__modal-content {
    position: relative;
    background: #fff;
    width: min(1100px, 90%);
    max-height: 85vh;
    margin: 5vh auto;
    border-radius: 14px;
    padding: 1.5rem;
    overflow-y: auto;
    animation: modalFadeIn .35s ease;
} */

/* CERRAR */
.section-cards__modal-close {
    position: absolute;
    top: 12px;
    right: 16px;
    font-size: 1.6rem;
    background: none;
    border: none;
    cursor: pointer;
}

/* TITULO */
.section-cards__modal-title {
    margin-bottom: 1rem;
    text-align: center;
}

/* GRID DE PRODUCTOS */
.section-cards__products-grid {
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1rem;
}

/* PRODUCTO */
.section-cards__product {
    text-align: center;
}

.section-cards__product img {
    width: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,.1);
}

.section-cards__product p {
    margin-top: .4rem;
    font-size: .85rem;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .section-cards__products-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 576px) {
    .section-cards__products-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* ANIMACIÓN */
@keyframes modalFadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
/* ===== CARRITO ===== */

.cart-list {
    padding: 0;
}

.cart-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

/* MINIATURA */
.cart-thumb {
    width: 56px;
    height: 56px;
    object-fit: cover;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,.15);
}

/* INFO */
.cart-info {
    flex: 1;
}

.cart-name {
    display: block;
    font-size: 0.9rem;
    margin-bottom: 4px;
}

/* CONTROLES */
.cart-controls {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.85rem;
}

.cart-qty {
    min-width: 28px;
    text-align: center;
    font-weight: bold;
}

/* DERECHA */
.cart-right {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 6px;
}

.cart-subtotal {
    color: #198754;
}

/* TOTAL */
.cart-total {
    margin-top: 1rem;
    padding: 0.75rem 1rem;
    background: #f8f9fa;
    border-radius: 10px;
    display: flex;
    justify-content: space-between;
    font-size: 1.05rem;
    font-weight: bold;
    color: #198754;
}
.cart-item {
    animation: cartFade .25s ease;
}

@keyframes cartFade {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}


  </style>
</head>
{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">

    <!-- Botón hamburguesa (solo visible en móvil) -->
    <button class="navbar-toggler order-1" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContenido">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Izquierda: Logo + Menú (colapsable) -->
    <div class="collapse navbar-collapse order-lg-1 order-2" id="navbarContenido">
      <div style="width:8em;"></div>
      <a class="navbar-brand d-lg-block d-none me-3" href="{{ route('market.index') }}" style="position: absolute;top:0;">
        <img src="{{asset('storage/' . $configapp->logo)}}" alt="Logo" class="d-inline-block align-text-top" style="height: 6em;">
      </a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#" style="font-weight: bold;font-size: 0.8em;" data-bs-toggle="modal" data-bs-target="#mapModal">
            <i class="bi bi-geo-alt-fill text-danger geo-btn"></i>
            Estás en Cochabamba
          </a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Productos</a>
        </li> -->
      </ul>
    </div>

    <!-- Centro: Buscador (siempre visible) -->
    <form class="d-flex flex-grow-1 justify-content-center order-3 order-lg-2 mx-2" action="{{route('market.index')}}" method="GET">
        @csrf  
    <input class="form-control w-100 w-lg-75" type="search" placeholder="Buscar..." aria-label="Buscar" style="border-radius: 20px;" required name="buscar" value="{{ request('buscar') }}">
    <button class="icon-btn" aria-label="Perfil" type="submit">
            <i class="bi bi-search"></i>
        </button>
    </form>
    
    <!-- Derecha: Íconos (colapsable) -->
    <div class="collapse navbar-collapse justify-content-end order-lg-3 order-4" id="navbarContenido">
      <div class="d-flex align-items-center ms-auto mt-2 mt-lg-0">
        <!-- Facebook -->
        <a href="{{$configapp->facebook ?? '#'}}"
          target="_blank"
          class="icon-btn"
          aria-label="Facebook">
            <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24">
                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
            </svg>
        </a>

        <!-- TikTok -->
        <a href="{{$configapp->tiktok ?? '#'}}"
          target="_blank"
          class="icon-btn"
          aria-label="TikTok">
            <svg xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24">
                <path d="M20 7.5c-2 0-3.8-1.2-4.6-3h-2.4v11.2a4 4 0 1 1-3-3.9V9.9a6.4 6.4 0 1 0 7 6.3V9.1c1.1.8 2.4 1.2 3.8 1.2V7.5z"
                      stroke="Gray"
                      stroke-width="1.8"
                      fill="Gray"
                      stroke-linecap="round"
                      stroke-linejoin="round"/>
            </svg>
        </a>

        <button class="icon-btn" aria-label="Likes">
            <i class="bi bi-house"></i>
        </button>
        <button class="icon-btn position-relative" aria-label="Carrito" data-bs-toggle="modal" data-bs-target="#modalCarrito">
            <i class="bi bi-cart"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cartCount">
              0
            </span>
        </button>
        <button class="icon-btn" aria-label="Perfil">
            <i class="bi bi-person-circle"></i>
        </button>
        
      </div>
    </div>

  </div>
</nav>
    <div class="bg-light border-bottom py-1">
        <div class="container d-flex justify-content-between align-items-center">
            <!-- Select de categorías -->
            <div class="dropdown" style="margin-left:10em;">
                <button class="btn btn-sm btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 15px;padding: 5px 20px;">
                    <i class="bi bi-list"></i>
                    Categorías
                </button>
                <ul class="dropdown-menu shadow-sm">
                    <li><a class="dropdown-item" href="#">Herramientas</a></li>
                    <li><a class="dropdown-item" href="#">Jardinería</a></li>
                    <li><a class="dropdown-item" href="#">Cerrajería</a></li>
                    <li><a class="dropdown-item" href="#">Carpintería</a></li>
                    <li><a class="dropdown-item" href="#">Otros</a></li>
                </ul>
            </div>

            <!-- Opciones de texto -->
            <div class="d-none d-lg-flex gap-5">
            <a href="#" class="text-decoration-none text-dark small">Hogar</a>
            <a href="#" class="text-decoration-none text-dark small">Jardinería</a>
            <a href="#" class="text-decoration-none text-dark small">Herramientas</a>
            <a href="#" class="text-decoration-none text-dark small">Cerrajería</a>
            <a href="#" class="text-decoration-none text-dark small">Carpintería</a>
            <a href="#" class="text-decoration-none text-dark small">Otros</a>
            </div>
            <div class="d-block d-lg-none">
              <button class="icon-btn position-relative" aria-label="Carrito" data-bs-toggle="modal" data-bs-target="#modalCarrito">
                  <i class="bi bi-cart"></i>
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cartCount">
                    0
                  </span>
              </button>
            </div>

        </div>
    </div>
  <main class="container-fluid px-0 py-2">
    @yield('content')
  </main>
@php
    // Número sin símbolos: cambiar si tu país no es Bolivia (591)
    $whatsappPhone = $configapp->whatsapp ?? '59179760327';
    $whatsappMessage = 'más información por favor...';
    $waTextEncoded = urlencode($whatsappMessage);
    // Enlace recomendado: wa.me para móviles y web
    $waLink = "https://wa.me/{$whatsappPhone}?text={$waTextEncoded}";
@endphp

<a 
    href="{{ $waLink }}"
    target="_blank"
    class="whatsapp-btn"
>
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg"
         alt="WhatsApp" />
</a>

 <footer class="footer-map mt-5">
        {{-- <small>&copy; {{ date('Y') }} - El Ofertón</small> --}}

  <div class="container py-4">
        <div class="row g-4">

            <!-- MAPA -->
            <div class="col-md-4" data-bs-toggle="modal" data-bs-target="#mapModal" style="cursor:pointer;">
                <h6 class="footer-title" >Ubicación</h6>
                <div id="map-footer"></div>
            </div>

            <!-- DIRECCIÓN -->
            <div class="col-md-4">
                <h6 class="footer-title">Dirección</h6>
                <p class="footer-text">
                    <i class="fa-solid fa-location-dot me-2"></i>
                    Av. Beiging<br>
                    casi Av. Topater,<br> 
                    Cochabamba - Bolivia
                </p>
                <h6 class="footer-title">Atención</h6>
                <p class="footer-text">
                    <i class="fa-solid fa-clock me-2"></i>
                    {!! nl2br($configapp->horario ?? 'Lun - Vie: 8:00 - 18:00') !!}
                </p>
            </div>

            <!-- REDES SOCIALES -->
            <div class="col-md-4">
                <h6 class="footer-title">Síguenos</h6>

                <div class="social-links">
                    <a href="{{$configapp->facebook}}" target="_blank">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>

                    <a href="{{$configapp->tiktok}}" target="_blank">
                        <i class="fa-brands fa-tiktok"></i>
                    </a>

                    <a href="{{$configapp->whatsapp}}" target="_blank">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>

        </div>

        <hr class="footer-divider">
        <p style="text-align:center;">
          © 2025 El Ofertón Online.
        </p>
        {{-- <div class="text-center footer-copy">
            © {{ date('Y') }} Tu Empresa. Todos los derechos reservados.
        </div> --}}
    </div>

    <div class="d-flex flex-column  justify-content-between">
      
      <ul class="list-unstyled d-flex">
        <li class="ms-3">
          <a class="link-body-emphasis" href="#" aria-label="Instagram">
            <svg class="bi" width="24" height="24">
              <use xlink:href="#instagram">
              </use>
            </svg>
          </a>
        </li>
        <li class="ms-3">
          <a class="link-body-emphasis" href="#" aria-label="Facebook">
            <svg class="bi" width="24" height="24" aria-hidden="true">
              <use xlink:href="#facebook">
              </use>
            </svg>
          </a>
        </li>
      </ul>
    </div>

<!-- Modal con mapa -->
<div class="modal fade" id="mapModal" tabindex="-1" aria-labelledby="mapModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark" id="mapModalLabel">Ubicación en Cochabamba</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body p-0">
        <div id="map" style="height: 500px; width: 100%;"></div>
      </div>
    </div>
  </div>
</div>

<!-- popup aÑadir al carrito -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
    <div id="toastCarrito" class="toast align-items-center text-bg-success border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body">
                Producto añadido al carrito 🛒
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<!-- modal para ver el carrito -->
<div class="modal fade" id="modalCarrito" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-dark">🛒 Carrito de Compras</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="carritoDetalles">
        <p>Tu carrito está vacío.</p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-outline-danger" data-bs-dismiss="modal">Cerrar</button>
        <button class="btn btn-success" onclick="contactarVentas()">
          <i class="bi bi-whatsapp"></i> Contactar a VENTAS
        </button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Producto -->
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
        <button type="button" class="btn btn-success add-cart btn-add-to-cart" id="productoModalAddCartBtn" 
          {{-- data-id="{{ $producto->id }}" 
          data-nombre="{{ $producto->descripcion }}" 
          data-precio="{{ $producto->precioventa }}" 
          data-img="{{ $producto->img1 ? asset('storage/'.$producto->img1) : asset('imagenes/toolsplaceholder.png') }}" --}}
          >
          Añadir al carrito
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    let carrito=[];
    document.addEventListener('DOMContentLoaded', function() {
    const elementos = document.querySelectorAll('.slide-up');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('show');
                observer.unobserve(entry.target); // opcional, solo animar 1 vez
            }
        });
    }, { threshold: 0.1 });

    elementos.forEach(el => observer.observe(el));

    // Cuando el modal del mapa se abre, inicializamos el mapa
    var map;
    var modal = document.getElementById('mapModal');
    modal.addEventListener('shown.bs.modal', function () {
      if (!map) {
        // Coordenadas de Cochabamba, Bolivia
        var cochabambaCoords = [{{ $latitud }}, {{ $longitud }}];

        map = L.map('map').setView(cochabambaCoords, 13);

        // Capa de mapa (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        // Icono centrado en Cochabamba
        L.marker(cochabambaCoords).addTo(map)
          .bindPopup("📍 El Ofertón")
          .openPopup();
      }
    });

      carrito = JSON.parse(localStorage.getItem('carrito')) || [];

  function actualizarContador() {
    const elements = document.querySelectorAll('.cartCount');
    elements.forEach(el => el.innerText = carrito.length);
    // const el = document.getElementById('cartCount');
    // if (el) el.innerText = carrito.length;
  }

  function guardarYActualizar() {
    localStorage.setItem('carrito', JSON.stringify(carrito));
    actualizarContador();
  }

  function renderizarCarrito() {
    const cont = document.getElementById('carritoDetalles');
    if (!cont) return;

    if (carrito.length === 0) {
      cont.innerHTML = '<p>Tu carrito está vacío.</p>';
      return;
    }
    console.log(carrito);
    let html = `<ul class="list-group cart-list">`;
let total = 0;

carrito.forEach((p, i) => {
  const subtotal = p.precio * p.cantidad;
  total += subtotal;

  html += `
      <li class="list-group-item cart-item">
        
        <img src="${p.img}" class="cart-thumb" alt="${p.nombre}">

        <div class="cart-info">
          <strong class="cart-name">${p.nombre}</strong>

          <div class="cart-controls">
            <button class="btn btn-sm btn-outline-secondary btn-restar" data-index="${i}">−</button>
            <span class="cart-qty">${p.cantidad}</span>
            <button class="btn btn-sm btn-outline-secondary btn-sumar" data-index="${i}">+</button>
            <span class="cart-price" style="border:1px solid lightgreen;border-radius:4px;background:lightyellow;">c/u Bs. ${p.precio}</span>
          </div>
        </div>

        <div class="cart-right">
          <button class="btn btn-sm btn-light btn-remove" data-index="${i}" title="Eliminar">✕</button>
          <strong class="cart-subtotal">Bs. ${subtotal}</strong>
        </div>

      </li>
    `;
  });

  html += `
    </ul>

    <div class="cart-total">
      <span>Total a pagar</span>
      <span>Bs. ${total}</span>
    </div>
  `;

  cont.innerHTML = html;


    // listeners dinámicos
    cont.querySelectorAll('.btn-remove').forEach(btn => {
      btn.addEventListener('click', () => {
        const idx = btn.dataset.index;
        carrito.splice(idx, 1);
        guardarYActualizar();
        renderizarCarrito();
      });
    });

    cont.querySelectorAll('.btn-sumar').forEach(btn => {
      btn.addEventListener('click', () => {
        const idx = btn.dataset.index;
        carrito[idx].cantidad++;
        guardarYActualizar();
        renderizarCarrito();
      });
    });

    cont.querySelectorAll('.btn-restar').forEach(btn => {
      btn.addEventListener('click', () => {
        const idx = btn.dataset.index;
        if (carrito[idx].cantidad > 1) {
          carrito[idx].cantidad--;
        } else {
          carrito.splice(idx, 1);
        }
        guardarYActualizar();
        renderizarCarrito();
      });
    });
  }

  // añadir al carrito
  // document.querySelectorAll('.btn-add-to-cart').forEach(btn => {
  //   btn.addEventListener('click', () => {
  document.addEventListener('click', (event) => {
    const btn = event.target.closest('.btn-add-to-cart');
    if (!btn) return;
      console.log('Añadiendo al carrito...');
      const id = btn.dataset.id;
      const nombre = btn.dataset.nombre;
      const precio = parseFloat(btn.dataset.precio);
      const img = btn.dataset.img;
      // Buscar si ya está en carrito
      const index = carrito.findIndex(p => p.id === id);
      if (index >= 0) {
        carrito[index].cantidad += 1;
      } else {
        carrito.push({ id, nombre, precio, cantidad: 1 , img });
      }

      guardarYActualizar();

      const toast = new bootstrap.Toast(document.getElementById('toastCarrito'));
      toast.show();
    });
  // });

  // show modal -> renderizar
  const modalCarrito = document.getElementById('modalCarrito');
  if (modalCarrito) modalCarrito.addEventListener('show.bs.modal', renderizarCarrito);

  // init
  actualizarContador();

});
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        // Coordenadas de la tienda (ejemplo)
        const lat = {{ $latitud }};
        const lng = {{ $longitud }};

        const map = L.map('map-footer', {
            zoomControl: false
        }).setView([lat, lng], 15);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        L.marker([lat, lng])
            .addTo(map)
            .bindPopup("<strong>Tu Tienda</strong><br>Av. Ejemplo #123");
        const modal = new bootstrap.Modal(document.getElementById('productoModal'));

        // document.querySelectorAll(".open-product-modal").forEach(img => {
        //     img.addEventListener("click", () => {
        document.addEventListener("click", (event) => {
            const img = event.target.closest('.open-product-modal');
            if (!img) return;
                // Llenar modal
                document.getElementById("productoModalLabel").textContent = img.dataset.marca;
                document.getElementById("productoModalImg").src = img.dataset.img;
                document.getElementById("productoModalDescripcion").textContent = img.dataset.descripcion;
                document.getElementById("productoModalPrecio").textContent = img.dataset.precio;

                // Añadir evento al botón agregar carrito
                const addBtn = document.getElementById("productoModalAddCartBtn");
                addBtn.setAttribute("data-id", img.dataset.id);
                addBtn.setAttribute("data-nombre", img.dataset.descripcion);
                addBtn.setAttribute("data-precio", img.dataset.precio);
                addBtn.setAttribute("data-img", img.dataset.img);
                modal.show();
            });
        // });
    });
</script>
<script>
// function openCardModal(id) {
//     const modal = document.getElementById(id);
//     if (!modal) return;

//     modal.classList.add('active');
//     document.body.style.overflow = 'hidden';
// }

// function closeCardModal(id) {
//     const modal = document.getElementById(id);
//     if (!modal) return;

//     modal.classList.remove('active');
//     document.body.style.overflow = '';
// }
function contactarVentas() {
    if (!Array.isArray(carrito) || carrito.length === 0) {
        alert('El carrito está vacío');
        return;
    }

    fetch('{{ route("registrarcarrito") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            productos: carrito,
            estado: 'pendiente',
            comentarios: null
        })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data.success) {
          const carritoId = data.carritoId;
          const telefono = '{{$configapp->whatsapp}}'; // Bolivia
          const mensaje = `Hola, acabo de realizar un pedido.%0AID del carrito: ${carritoId}`;
          const urlWhatsapp = `https://wa.me/${telefono}?text=${mensaje}`;
          window.open(urlWhatsapp, '_blank');
        } else {
            alert('Ocurrió un error al registrar el carrito');
        }
    })
    .catch(err => {
        console.error(err);
        alert('Error de conexión');
    });
}



function openCardModal(sectionId, index, titulo) {
    const modal = document.getElementById('modalProductos_' + sectionId);
    const grid = document.getElementById('modalProductosGrid_' + sectionId);
    const titleEl = document.getElementById('modalTitulo_' + sectionId);
    // console.log('Abriendo modal para sección:', sectionId, 'índice:', index, ' y titulo: ', titulo, 'titleEl:', titleEl);
    titleEl.textContent = titulo;
    grid.innerHTML = '';

    const cardsData = window.cardsDataMap[sectionId];
    console.log('cardsData:', cardsData);
    const cardData = cardsData.find(c => c.index === index);
    if (!cardData) return;

    cardData.productos.forEach(producto => {
        const html = `
            <div class="section-cards__product">
                <div class="card product-card h-100 rounded">
                    <img 
                        src="${producto.img1 ? '{{ asset("storage/") }}' + '/' + producto.img1 : '{{ asset("imagenes/toolsplaceholder.png") }}'}"
                        class="card-img-top open-product-modal"
                        alt="Producto"
                        style="object-fit:cover; cursor:pointer;"
                        data-id="${producto.id}"
                        data-marca="${producto.marca}"
                        data-descripcion="${producto.descripcion}"
                        data-precio="${producto.precioventa}"
                        data-img="${producto.img1 ? '{{ asset("storage/") }}' + '/' + producto.img1 : '{{ asset("imagenes/toolsplaceholder.png") }}'}"
                    >
                    <div class="card-body d-flex flex-column p-2">
                        <h6 class="card-title mb-1">${producto.marca}</h6>
                        <p class="card-text text-truncate mb-2 small">${producto.descripcion}</p>
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-secondary small">Bs.${producto.precioventa}</span>
                            <span>
                                <a href="https://wa.me/{{ $whatsappPhone }}?text=Consulta%20por%20producto:%20${encodeURIComponent(producto.idprod)}" target="_blank" class="btn btn-sm btn-outline-success add-cart">
                                    <i class="bi bi-whatsapp"></i>
                                </a>
                                <button class="btn btn-success btn-sm add-cart btn-add-to-cart" data-id="${producto.id}" data-nombre="${producto.descripcion}" data-precio="${producto.precioventa}" data-img="${producto.img1 ? '{{ asset("storage/") }}' + '/' + producto.img1 : '{{ asset("imagenes/toolsplaceholder.png") }}'}">Añadirx</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        `;
        grid.insertAdjacentHTML('beforeend', html);
    });

    modal.classList.add('active');
}

function closeCardModal(sectionId) {
    const modal = document.getElementById('modalProductos_' + sectionId);
    modal.classList.remove('active');
}
</script>

</body>
</html>
