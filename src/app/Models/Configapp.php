<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configapp extends Model
{
    //
    protected $table = 'configapp';
    protected $fillable = [
        'whatsapp',
        'nrocuenta',
        'banco',
        'titularcuenta',
        'facebook',
        'tiktok',
        'latitud',
        'longitud',
        'logo',
        'horario',
    ];
}
