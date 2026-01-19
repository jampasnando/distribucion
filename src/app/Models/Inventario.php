<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    //
    protected $fillable = ['idprod', 'marca', 'cantidad', 'categoria', 'unidad', 'preciolocal', 'precioventa', 'comision', 'deposito', 'proveedor', 'descripcion', 'imagenes', 'img1', 'img2', 'img3'];
}
