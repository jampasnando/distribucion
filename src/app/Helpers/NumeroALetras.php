<?php

namespace App\Helpers;

class NumeroALetras
{
    public static function convertir($numero)
    {
        $entero = floor($numero);
        $decimal = round(($numero - $entero) * 100);

        $letras = self::convertirNumero($entero);

        $decimal = str_pad($decimal, 2, '0', STR_PAD_LEFT);

        return strtoupper("$letras con $decimal/100");
    }

    private static function convertirNumero($num)
    {
        $unidad = [
            '', 'uno', 'dos', 'tres', 'cuatro', 'cinco',
            'seis', 'siete', 'ocho', 'nueve'
        ];

        $decenas = [
            10 => 'diez', 11 => 'once', 12 => 'doce',
            13 => 'trece', 14 => 'catorce', 15 => 'quince',
            20 => 'veinte', 30 => 'treinta', 40 => 'cuarenta',
            50 => 'cincuenta', 60 => 'sesenta',
            70 => 'setenta', 80 => 'ochenta', 90 => 'noventa'
        ];

        $centenas = [
            100 => 'cien', 200 => 'doscientos', 300 => 'trescientos',
            400 => 'cuatrocientos', 500 => 'quinientos',
            600 => 'seiscientos', 700 => 'setecientos',
            800 => 'ochocientos', 900 => 'novecientos'
        ];

        if ($num < 10) return $unidad[$num];

        if ($num < 16) return $decenas[$num];

        if ($num < 20) return 'dieci' . $unidad[$num - 10];

        if ($num == 20) return 'veinte';

        if ($num < 30) return 'veinti' . $unidad[$num - 20];

        if ($num < 100) {
            $d = floor($num / 10) * 10;
            $u = $num % 10;
            return $decenas[$d] . ($u ? ' y ' . $unidad[$u] : '');
        }

        if ($num == 100) return 'cien';

        if ($num < 200) return 'ciento ' . self::convertirNumero($num - 100);

        if ($num < 1000) {
            $c = floor($num / 100) * 100;
            $r = $num % 100;
            return $centenas[$c] . ($r ? ' ' . self::convertirNumero($r) : '');
        }

        if ($num < 2000) return 'mil ' . self::convertirNumero($num % 1000);

        if ($num < 1000000) {
            $m = floor($num / 1000);
            $r = $num % 1000;
            return self::convertirNumero($m) . ' mil' . ($r ? ' ' . self::convertirNumero($r) : '');
        }

        if ($num < 2000000) return 'un millón ' . self::convertirNumero($num % 1000000);

        if ($num < 1000000000000) {
            $m = floor($num / 1000000);
            $r = $num % 1000000;
            return self::convertirNumero($m) . ' millones' . ($r ? ' ' . self::convertirNumero($r) : '');
        }

        return '';
    }
}
