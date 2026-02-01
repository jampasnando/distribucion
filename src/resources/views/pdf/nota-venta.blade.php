<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; }
        th { background: #f0f0f0; }
        .header { text-align: center; }
        .totales { text-align: right; margin-top: 10px; }
    </style>
</head>
<body>

<div class="header">
    <h2>NOTA DE VENTA</h2>
    <strong>N° {{ $venta->id }}</strong>
</div>

<p>
    <strong>Fecha:</strong> {{ $venta->created_at->format('d/m/Y') }}<br>
    <strong>Cliente:</strong> {{ $venta->cliente->nombre }}<br>
    <strong>NIT / CI:</strong> {{ $venta->cliente->nit ?? '-' }}<br>
    <strong>Tipo de venta:</strong> {{ ucfirst($venta->formapago ?? 'contado') }}
</p>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Cód.</th>
            <th>Producto</th>
            <th>Cant.</th>
            <th>Precio</th>
            <th>Desc.</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @php $total = 0; @endphp

        @foreach ($venta->inventarios as $i => $inv)
            @php
                $cantidad = $inv->pivot->cantidad;
                $precio   = $inv->pivot->preciofinal;
                $descuento = $inv->pivot->descuento ?? 0;
                $subtotal = ($cantidad * $precio) - $descuento;
                $total += $subtotal;
            @endphp

            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $inv->pivot->idprod }}</td>
                <td>{{ $inv->pivot->descripcion ?? $inv->descripcion }}</td>
                <td align="center">{{ $cantidad }}</td>
                <td align="right">{{ number_format($precio, 2) }}</td>
                <td align="right">{{ number_format($descuento, 2) }}</td>
                <td align="right">{{ number_format($subtotal, 2) }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<div class="totales">
    <strong>TOTAL Bs {{ number_format($total, 2) }}</strong>
</div>

</body>
</html>
