<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<style>
    body {
        font-family: DejaVu Sans;
        font-size: 10px;
        margin: 20px;
    }

    .header {
        text-align: center;
        line-height: 1.1;
    }

    .title {
        font-size: 14px;
        font-weight: bold;
        margin-top: 5px;
    }

    .box {
        width: 100%;
        margin-top: 8px;
    }

    .box td {
        padding: 3px;
        vertical-align: top;
    }

    .border {
        border: 1px solid #000;
    }

    .no-border td {
        border: none;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 8px;
    }

    th, td {
        /* border: 1px solid #000; */
        padding: 4px;
    }

    th {
        background: #eee;
        font-size: 9px;
    }

    .center { text-align: center; }
    .right { text-align: right; }

    .small { font-size: 9px; }

    .totales {
        margin-top: 5px;
    }

    .firmas {
        margin-top: 40px;
        width: 100%;
    }

    .firmas td {
        border: none;
        text-align: center;
        padding-top: 25px;
    }

</style>
</head>
<body>

<!-- HEADER -->
<div class="header">
    <table>
        <tr>
            <td>
                <div style='text-align:left'>
                {{-- <strong>EL OFERTON FERRETERIA ONLINE COCHABAMBA</strong><br> --}}
                <strong>IRMÃO</strong>
                Av. Beijing entre 15 de Agosto y Av. Topater<br>
                Telf.: 62606092<br>
                Cercado, Cochabamba
                </div>
            </td>
            <td style="text-align: right;">
                <strong>N°:</strong> {{ str_pad($venta->id ?? 5844, 6, '0', STR_PAD_LEFT) }}<br>
                <strong>Página:</strong> 1
            </td>
        </tr>
    </table>


    <div class="title">NOTA DE ENTREGA</div>
</div>

<!-- INFO -->
<table class="box border">
    <tr>
        <td colspan="2"><strong>CLIENTE:</strong> {{ $venta->cliente->nombre ?? '' }}</td>
        <td style="text-align: right;"><strong></strong></td>
    </tr>
    <tr>
        <td><strong>NIT/CI:</strong> {{ $venta->cliente->nit ?? '4034846012' }}</td>
         <td><strong>VENDEDOR:</strong> {{ $venta->vendedor->nombre ?? '' }}</td>
         <td style="text-align: right"><strong>FECHA:</strong> {{ optional($venta->created_at)->format('d/m/Y') ?? '18/03/2026' }}</td>


    </tr>
    <tr>
         <td><strong>CÓDIGO:</strong> {{ $venta->cliente->codigo ?? '403484' }}</td>
        <td><strong>ZONA:</strong> {{ $venta->zona ?? '5 - TEAM VIAJE' }}</td>
        <td style="text-align: right"><strong>TIPO_PAGO:</strong> {{ ucfirst($venta->formapago ?? 'Crédito') }}</td>
    </tr>
    <tr>
        <td colspan="2"><strong>DIRECCIÓN:</strong> {{ $venta->cliente->direccion ?? 'BEIGIN Y PUENTE TOPATER' }}</td>
        <td style="text-align: right"><strong>PLAZO:</strong> {{ $venta->plazo ?? 0 }} días</td>
    </tr>
</table>

<!-- TABLA -->
<table>
    <thead>
        <tr>
            <th width="12%">Código</th>
            <th width="6%">Cant</th>
            <th width="38%">Descripción</th>
            <th width="12%">Lote/Venc</th>
            <th width="10%">Precio</th>
            <th width="10%">Importe</th>
            <th width="12%">Desc</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp

        @forelse ($venta->inventarios ?? [] as $inv)
            @php
                $cantidad = $inv->pivot->cantidad ?? 1;
                $precio = $inv->pivot->preciofinal ?? 100;
                $descuento = $inv->pivot->descuento ?? 0;
                $subtotal = ($cantidad * $precio) - $descuento;
                $total += $subtotal;
            @endphp
            <tr>
                <td>{{ $inv->pivot->idprod ?? 'FCID230LX-2' }}</td>
                <td class="center">{{ $cantidad }}</td>
                <td>{{ $inv->pivot->descripcion ?? 'Producto de ejemplo' }}</td>
                <td class="center small">{{ $inv->lote ?? '27 / 01-12-2025' }}</td>
                <td class="right">{{ number_format($precio, 2) }}</td>
                <td class="right">{{ number_format($subtotal, 2) }}</td>
                <td class="right">{{ number_format($descuento, 2) }}</td>
            </tr>
        @empty
            <!-- FILAS DE PRUEBA -->
            <tr>
                <td>FCID230LX-2</td>
                <td class="center">1</td>
                <td>JUEGO DE IMPACTO SIN ESCOBILLAS</td>
                <td class="center small">27 / 01-12-2025</td>
                <td class="right">786.56</td>
                <td class="right">786.56</td>
                <td class="right">0.00</td>
            </tr>
            @php $total = 786.56; @endphp
        @endforelse
    </tbody>
</table>

<!-- TOTALES -->
<table class="totales no-border">
    <tr>
        <td width="70%">
            <strong>Son:</strong>
            {{ \App\Helpers\NumeroALetras::convertir($total) }} Bolivianos
        </td>
        <td width="30%" class="right">
            <strong>TOTAL Bs {{ number_format($total, 2) }}</strong>
        </td>
    </tr>
</table>

<!-- DETALLE -->
<p class="small">
    {{-- <strong>DETALLE:</strong> Venta por Web |
    <strong>N° DE LOTE(S):</strong> 27, 39 --}}
</p>

<!-- FIRMAS -->
<table class="firmas">
    <tr>
        <td>Elaborado por</td>
        <td>Recibido por</td>
        <td>Aprobado por</td>
    </tr>
</table>

</body>
</html>
