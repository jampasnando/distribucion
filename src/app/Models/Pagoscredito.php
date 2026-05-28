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

    protected static function booted(): void
    {
        static::created(function (Pagoscredito $pago): void {
            $credito = $pago->credito;

            if (! $credito) {
                return;
            }

            $saldoRestante = $credito->saldo - $credito->pagoscreditos()->sum('monto');

            if ($saldoRestante <= 0) {
                $credito->update([
                    'estado' => 'cancelado',
                ]);
            }
        });
    }

    public function credito()
    {
        return $this->belongsTo(Credito::class, 'credito_id');
    }
    
}
