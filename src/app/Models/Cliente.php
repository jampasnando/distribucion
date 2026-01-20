<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    
    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'ci',
        'nit',
        'telefono',
        'celular',
        'ciudad',
        'latitud',
        'longitud',
        'direccion',
        'ruta',
        'circuito',
        'banco',
        'nrocuenta'
    ];
}
