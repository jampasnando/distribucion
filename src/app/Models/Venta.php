<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $fillable = [
        'cliente_id',
        'fecha',
        'total',
        'estado',
        'idventa',
        'deposito_id',
        'formapago'
    ];
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class, 'inventario_venta')
            ->withPivot(['cantidad', 'precioventa', 'preciocompra','preciofinal','comision','vendedor_id','pagocomision','descripcion','idprod'])
            ->withTimestamps();
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
}
