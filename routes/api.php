<?php

use App\Http\Controllers\api\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiciosController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',function(){
    return response()->json([
        'message'=>'welcome to api '
    ]);
});
//de esto

// Route::get("/clients","App\Http\Controllers\ClientController@index");
// Route::post("/clients","App\Http\Controllers\ClientController@store");
// Route::get("/clients/{client}","App\Http\Controllers\ClientController@show");
// Route::put("/clients/{client}","App\Http\Controllers\ClientController@update");
// Route::delete("/clients/{client}","App\Http\Controllers\ClientController@destroy");


// Route::get("/services","App\Http\Controllers\ServiceController@index");
// Route::post("/services","App\Http\Controllers\ServiceController@store");
// Route::get("/services/{service}","App\Http\Controllers\ServiceController@show");
// Route::put("/services/{service}","App\Http\Controllers\ServiceController@update");
// Route::delete("/services/{service}","App\Http\Controllers\ServiceController@destroy");

// Route::post("/clients/service","App\Http\Controllers\ClientController@attach");

// a esto

//  Route::resource('clientes', ClientesController::class);

// Route::resource('empleado', EmpleadoController::class);

// Route::resource('services', ServiceController::class);

// Route::resource('departamento', DepartamentoController::class);

// Route::post('/clients/{client}/services', [ClientController::class, 'attach']);

// Route::post('/departamentos/{departamento}/empleados', [DepartamentoController::class, 'attach']);

// Route::resource('departamento', DepartamentoController::class);


// Route::post('/files', [FileController::class, 'store']);
// Route::get('/files/{id}', [FileController::class, 'show']);
// Route::put('/files/{id}', [FileController::class, 'update']);
// Route::delete('/files/{id}', [FileController::class, 'destroy']);

Route::resource('clientes', ClientesController::class);

Route::controller(ClientesController::class)->group(function () {

    Route::get('/clientes', 'index');
    Route::post('/clientes/store', 'store');
    Route::get('/clientes/{cliente}/show', 'show');
    Route::put('/clientes/{cliente}/update', 'update');
    Route::delete('/api/clientes/{cliente}', 'ClientesController@destroy');

});

Route::controller(ServiciosController::class)->group(function () {

    Route::get('/servicios', 'index');
    Route::post('/servicios/store', 'store');
    Route::get('/servicios/{servicio}/show', 'show');
    Route::put('/servicios/{servicio}/update', 'update');
    Route::delete('/api/servicios/{servicio}', 'ServiciosController@destroy');

});
