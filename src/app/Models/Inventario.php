<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $fillable = ['idprod', 'marca_id', 'cantidad', 'categoria', 'unidad', 'preciocompra', 'precioventa', 'comision', 'deposito', 'proveedor_id', 'descripcion', 'imagenes', 'img1', 'img2', 'img3'];
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
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function ofertas()
    {
        return $this->hasMany(Oferta::class);
    }

    public function ofertaActiva()
    {
        return $this->hasOne(Oferta::class)
            ->where('activo', 1)
            ->whereDate('fecha_inicio', '<=', now())
            ->whereDate('fecha_fin', '>=', now());
    }
}

