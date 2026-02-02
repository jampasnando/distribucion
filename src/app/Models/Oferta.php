<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Oferta extends Model
{
    protected $fillable = [
        'inventario_id',
        'precio_oferta',
        'fecha_inicio',
        'fecha_fin',
        'activo'
    ];
    
}
