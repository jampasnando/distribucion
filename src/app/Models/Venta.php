<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'cliente_id',
        'fecha',
        'total',
        'estado',
    ];
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class, 'inventario_venta')
            ->withPivot(['cantidad', 'precioventa', 'preciocompra','preciofinal','comision','vendedor_id','pagocomision','descripcion'])
            ->withTimestamps();
    }
}
