<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    protected $table = 'creditos';

    protected $fillable = [
        'venta_id',
        'cliente_id',
        'total',
        'saldo',
        'fechainicio',
        'fechavencimiento',
        'estado',
    ];

    public function venta()
    {
        return $this->belongsTo(Venta::class, 'venta_id');
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function pagos()
    {
        return $this->hasMany(Pagoscredito::class, 'credito_id');
    }
}
