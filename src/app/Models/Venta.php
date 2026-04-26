<?php

namespace App\Models;

use App\Models\Vendedor;
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
        'formapago',
        'user_id',
        'vendedor_id'
    ];
    public function inventarios()
    {
        return $this->belongsToMany(Inventario::class, 'inventario_venta')
            ->withPivot(['cantidad', 'precioventa', 'preciocompra','preciofinal','comision','vendedor_id','pagocomision','descripcion','idprod', 'descuento'])
            ->withTimestamps();
    }
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }
    public function credito()
    {
        return $this->hasOne(Credito::class, 'venta_id');
    }
    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class,'vendedor_id');
    }
}
