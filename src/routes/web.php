<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarritoController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [App\Http\Controllers\MarketController::class, 'index'])->name('market.index');
Route::get('market', [App\Http\Controllers\MarketController::class, 'index'])->name('market.index');
Route::get('buscar', [App\Http\Controllers\MarketController::class, 'buscar'])->name('market.buscar');
// Route::post('buscar',function(){
//     echo "hola";
// });
Route::post('registrarcarrito', [CarritoController::class, 'registrarCarrito'])->name('registrarcarrito');
