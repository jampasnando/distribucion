<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class Lista extends Model
{
    //
    protected $fillable = ['titulo','clave','orden','limite','estado'];
    protected $table = 'listas';

   //Accesor que siempre devuelve colección
    public function getProductosAttribute()
    {
       return Inventario::whereNotNull('img1')
        ->where('img1', '!=', '')
        ->where(function ($q) {
            $q->where('descripcion', 'like', "%{$this->clave}%")
            ->orWhere('marca', 'like', "%{$this->clave}%");
        })
        ->get() ?? collect([]);
    }

    // ✅ Método de productos paginados
    public function productosPaginados()
    {
        $limite = $this->limite ?? 10;
        return Inventario::whereNotNull('img1')
        ->where('img1', '!=', '')
        ->where(function ($q) {
            $q->where('descripcion', 'like', "%{$this->clave}%")
            ->orWhere('marca', 'like', "%{$this->clave}%");
        })
        ->paginate($limite, ['*'], 'page_'.$this->id);

    }

    // ✅ Scope: devuelve solo listas con productos
    public function scopeConProductos(Builder $query)
    {
        return $query->get()->filter(function ($lista) {
            return $lista->productos->isNotEmpty();
        });
    }
}
