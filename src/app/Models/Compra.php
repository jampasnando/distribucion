<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    protected $table = 'compras';
    protected $fillable = [
        'deposito_id',
        'idcompra',
        'proveedor_id',
        'fecha',
        'total',
        'formapago',
        'nit',
        'factura',
        'comentario',
        'user_id',
    ];
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class, 'compra_inventario')
            ->withPivot(['cantidad', 'preciocompra', 'idprod', 'descripcion','fecha','idcompra'])
            ->withTimestamps();
    }
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'proveedor_id');
    }
}
