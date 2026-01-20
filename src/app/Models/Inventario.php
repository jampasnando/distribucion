<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $fillable = ['idprod', 'marca', 'cantidad', 'categoria', 'unidad', 'preciocompra', 'precioventa', 'comision', 'deposito', 'proveedor', 'descripcion', 'imagenes', 'img1', 'img2', 'img3'];
    public function ventas()
    {
        return $this->belongsToMany(Venta::class, 'inventario_venta')
            ->withPivot(['cantidad', 'precioventa', 'preciocompra','preciofinal','comision','vendedor_id','pagocomision','descripcion'])
            ->withTimestamps();
    }
    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }
}

