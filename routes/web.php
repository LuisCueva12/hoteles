<?php

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservaController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'crear'])->name('login');
    Route::post('/login', [LoginController::class, 'autenticar'])
        ->middleware('throttle:5,1')
        ->name('login.post');
});

Route::get('/', [CatalogoController::class, 'inicio'])->name('inicio');
Route::get('/hoteles', [CatalogoController::class, 'catalogo'])->name('hoteles.catalogo');
Route::get('/contacto', [CatalogoController::class, 'contacto'])->name('contacto');
Route::post('/contacto', function () {
    return redirect()->route('contacto')->with('success', 'Mensaje enviado correctamente');
});
Route::get('/hotel/{hotel}', [CatalogoController::class, 'detalle'])->name('hotel.detalle');

Route::post('/reservar', [ReservaController::class, 'store'])
    ->middleware('throttle:3,10')
    ->name('reservar');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destruir'])->name('logout');
});
