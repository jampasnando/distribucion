<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    //
    protected $fillable = ['nombre', 'pais', 'logo'];
    public function inventarios()
    {
        return $this->hasMany(Inventario::class);
    }
}
