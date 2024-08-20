<?php

use App\Http\Controllers\AlumnoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\MatriculaController;
use App\Http\Controllers\UnidadController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Models\Inscripcion;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::resource('categorias', CategoriaController::class);
    Route::resource('unidades', UnidadController::class);
    Route::resource('productos', ProductoController::class);
    Route::resource('ventas', VentaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('alumnos', AlumnoController::class);
    Route::resource('matriculas', MatriculaController::class);
    Route::resource('inscripciones', InscripcionController::class);
});
