<?php

use App\Http\Controllers\CatalogoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\SeoController;
use Illuminate\Support\Facades\Route;



Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'crear'])->name('login');
    Route::post('/login', [LoginController::class, 'autenticar'])
        ->middleware('throttle:5,1')
        ->name('login.post');
});

Route::get('/', [CatalogoController::class, 'inicio'])->name('inicio');
Route::get('/flota', [CatalogoController::class, 'flota'])->name('flota');
Route::get('/contacto', [CatalogoController::class, 'contacto'])->name('contacto');
Route::post('/contacto', function () {
    return redirect()->route('contacto')->with('success', 'Mensaje enviado correctamente');
});
Route::get('/movilidad/{movilidad}', [CatalogoController::class, 'detalle'])->name('movilidad.detalle');

Route::post('/reservar', [ReservaController::class, 'store'])
    ->middleware('throttle:3,10')
    ->name('reservar');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destruir'])->name('logout');
});
