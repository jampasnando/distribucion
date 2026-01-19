@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')
@php
// dd($sections);
@endphp
@foreach($sections as $section)
    @includeIf('sections.' . $section->tipo, ['data' => $section])
@endforeach

@if(collect($sections)->contains('tipo','busqueda'))
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var el = document.getElementById('seccionbusqueda');
        if (!el) return;
        el.focus();
            el.scrollIntoView({ behavior: 'smooth', block: 'start' });
            return;
        // Para navegadores sin header fijo, usa scrollIntoView
        // var header = document.querySelector('.navbar, header');
        // if (!header) {
        //     el.setAttribute('tabindex','-1');
        //     el.focus();
        //     el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        //     return;
        // }

        // // Si hay header fijo, compensa su altura
        // var headerOffset = header.offsetHeight || 0;
        // var elementPosition = el.getBoundingClientRect().top + window.pageYOffset;
        // var offsetPosition = elementPosition - headerOffset - 10; // pequeño padding
        // window.scrollTo({ top: offsetPosition, behavior: 'smooth' });

        // // Llevar foco para accesibilidad
        // el.setAttribute('tabindex','-1');
        // el.focus();
    });
    </script>
@endif

@endsection
