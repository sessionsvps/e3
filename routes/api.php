<?php

use App\Http\Controllers\AlumnoController;
use App\Http\Controllers\ClienteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/clientes/{nro_doc}', [ClienteController::class, 'buscarPorNroDoc']);
Route::get('/alumnos/{dni}', [AlumnoController::class, 'buscarPorDni']);
