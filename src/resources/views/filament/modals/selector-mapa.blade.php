@php
    $lat = is_numeric($lat) ? $lat : -17.3935;   // Cochabamba
    $lng = is_numeric($lng) ? $lng : -66.1570;
@endphp

<div
    x-data="{
        map: null,
        marker: null,
        lat: {{ $lat }},
        lng: {{ $lng }},
        initMap() {
            this.map = L.map(this.$refs.map).setView([this.lat, this.lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
            }).addTo(this.map);

            this.marker = L.marker([this.lat, this.lng], { draggable: true }).addTo(this.map);

            // Al mover el pin
            this.marker.on('dragend', e => {
                const pos = e.target.getLatLng();
                this.lat = pos.lat;
                this.lng = pos.lng;
            });

            // Al hacer click en el mapa
            this.map.on('click', e => {
                this.marker.setLatLng(e.latlng);
                this.lat = e.latlng.lat;
                this.lng = e.latlng.lng;
            });

            setTimeout(() => this.map.invalidateSize(), 200);
        },
        acceptLocation() {
            // Enviar valores a Livewire
            console.log(this.lat,this.lng);
            $wire.dispatch('map-selected', [this.lat, this.lng]);
            // Cerrar el modal
            this.$dispatch('close-modal');
        }
    }"
    x-init="initMap()"
    style="height: 500px; width: 100%;"
>
    <div x-ref="map" style="height: 100%; width: 100%;"></div>

    <!-- Botones -->
    <div class="flex justify-end gap-2 mt-2 mb-2" style="width:100%;text-align:right;">
        <button
            style="border:1px solid gray;background:gold;padding:7px;border-radius:7px;"
            type="button"
            class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700"
            x-on:click="acceptLocation()"
        >
            Aceptar ubicación
        </button>
        <button
            style="border:1px solid gray;color:red;background:white;padding:7px;border-radius:7px;"
            type="button"
            class="inline-flex items-center px-4 py-2 bg-gray-200 rounded hover:bg-gray-300"
            x-on:click="$dispatch('close-modal')"
        >
            Cancelar
        </button>
    </div>
</div>
