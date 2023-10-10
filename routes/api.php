<?php

use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\EncargadoController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Rutas que requieren autenticación
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Rutas de Clientes
    Route::prefix('clientes')->group(function () {
        Route::get('/', [ClientesController::class, 'index']);
        Route::post('/store', [ClientesController::class, 'store']);
        Route::get('/{cliente}/show', [ClientesController::class, 'show']);
        Route::put('/{cliente}/update', [ClientesController::class, 'update']);
        Route::delete('/{cliente}', [ClientesController::class, 'destroy']);
    });

    // Rutas de Servicios
    Route::prefix('servicios')->group(function () {
        Route::get('/', [ServiciosController::class, 'index']);
        Route::post('/store', [ServiciosController::class, 'store']);
        Route::get('/{servicio}/show', [ServiciosController::class, 'show']);
        Route::put('/{servicio}/update', [ServiciosController::class, 'update']);
        Route::delete('/{servicio}', [ServiciosController::class, 'destroy']);
    });

     // Rutas de Clientes
     Route::prefix('encargados')->group(function () {
        Route::get('/', [EncargadoController::class, 'index']);
        Route::post('/store', [EncargadoController::class, 'store']);
        Route::get('/{encargado}/show', [EncargadoController::class, 'show']);
        Route::put('/{encargado}/update', [EncargadoController::class, 'update']);
        Route::delete('/{encargado}', [EncargadoController::class, 'destroy']);
    });
});

// Rutas públicas
Route::get('/', function () {


});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


// Esta ruta puede requerir autenticación, dependiendo de tus necesidades
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
