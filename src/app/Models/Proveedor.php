<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    protected $table = 'proveedores';
    protected $fillable = ['nombre', 'ci', 'nit', 'telefono', 'celular', 'ciudad', 'direccion', 'banco', 'nrocuenta'];
    public function inventarios()
    {
        return $this->hasMany(Inventario::class); 
    }
}
