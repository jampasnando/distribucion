<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    //
    protected $fillable = [
        'tipo',
        'parametros',
        'estado',
        'orden',
        'descripcion',
    ];  
    protected $casts = [
        'parametros' => 'array',
    ];
}
