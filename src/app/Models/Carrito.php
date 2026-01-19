<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $fillable = [
        'productos', // Almacena los productos en formato JSON
        'estado',
        'comentario'     // Almacena el total del carrito
    ];
    protected $casts = [
        'productos' => 'array', // Convierte automáticamente el campo productos a un array
    ];

    public function getResumenProductosAttribute(): string
    {
        $productos = $this->productos;

        if (!is_array($productos) || empty($productos)) {
            return '0 productos | Bs. 0.00';
        }

        $cantidad = count($productos);
        $total = 0;

        foreach ($productos as $p) {
            $precio = $p['precio'] ?? 0;
            $cant   = $p['cantidad'] ?? 0;
            $total += $precio * $cant;
        }

        return "{$cantidad} productos | Bs. " . number_format($total, 2);
    }
    public function getTotalAPagarAttribute(): float
    {
        // $productos = $this->productos;

        // if (!is_array($productos)) {
        //     return 0;
        // }

        // return collect($productos)->sum(function ($p) {
        //     return ($p['precio'] ?? 0) * ($p['cantidad'] ?? 0);
        // });
        return 100;
    }

}