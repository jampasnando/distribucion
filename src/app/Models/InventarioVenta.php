<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventarioVenta extends Model
{
    protected $table = 'inventario_venta';
    protected $fillable = ['inventario_id', 'venta_id', 'id_prod','cantidad', 'precioventa', 'preciocompra','preciofinal','comision','vendedor_id','pagocomision','descripcion'];
    public function inventario()
    {
        return $this->belongsTo(Inventario::class);
    }
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }
}
