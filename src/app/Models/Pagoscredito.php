<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagoscredito extends Model
{
    protected $fillable = [
        'credito_id',
        'monto',
        'fechapago',
        'metodopago',
        'comentarios',
    ];
    public function credito()
    {
        return $this->belongsTo(Credito::class, 'credito_id');
    }

}
