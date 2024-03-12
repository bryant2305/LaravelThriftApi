<?php

namespace App\Http\Controllers;

use App\Http\Resources\ClienteResource;
use App\Models\Clientes;
use Illuminate\Http\Request;
use App\Exceptions\SomethingWentWrong;
use App\Tools\MinioBucketTrait;
use Illuminate\Support\Facades\Cache;

class ClientesController extends Controller
{
    public const MODULO = 'clientes';

    /**
     * @OA\Get(
     *     tags={"Clients"},
     *     path="/api/clientes",
     *     summary="Get a listing of the clients",
     *     @OA\Parameter(
     *         name="nombre",
     *         in="query",
     *         description="Filter by client name",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Parameter(
     *         name="paginacion",
     *         in="query",
     *         description="Number of rows per page",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Schema(
     *                 type="string",
     *                 format="string",
     *                 example="tecnologia",
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     )
     * )
     */
    public function index(Request $request)
    {
        auth()->user()->hasPermiso('leer');

        try {
            $nombre = $request->query('nombre');
            $paginacion = $request->query('paginacion');

            $clients = Clientes::nombre($nombre, $paginacion);

            return ClienteResource::collection($clients);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);

        }
    }

   /**
 * Store a newly created client in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Post(
 *     path="/api/clientes/store",
 *     summary="Create a new client",
 *     tags={"Clients"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"nombre", "adress", "phone", "email"},
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="John Doe"
 *             ),
 *              @OA\Property(
 *                 property="servicios_id",
 *                 type="id",
 *                 example="1"
 *             ),
 *             @OA\Property(
 *                 property="address",
 *                 type="string",
 *                 example="123 Main St"
 *             ),
 *             @OA\Property(
 *                 property="phone",
 *                 type="string",
 *                 example="555-123-4567"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 example="john@example.com"
 *             ),
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Entity"
 *     )
 * )
 */
    public function store(Request $request)
    {
        auth()->user()->hasPermiso('crear');

        $request->validate([
            "nombre" => "required",
            "servicios_id"=>"required"
        ]);

        try{
            Cache::forget('clientes_index');
            $client = new Clientes();
            $client->nombre = $request->nombre;
            $client->servicios_id = $request->servicios_id;
            $client->address = $request->adress;
            $client->phone = $request->phone;
            $client->email = $request->email;
           // $client->image_data = $request->image_data;
            $client->save();

            $data = [
                "message" => "Client created successfully",
                "client" => $client
            ];
        }catch(\Throwable $th){

            throw new SomethingWentWrong($th);
        }



        return response()->json($data);
    }

    /**
 * Display the specified client.
 *
 * @param  int  $id
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Get(
 *     path="/api/clientes/{id}/show",
 *     summary="Get a specific client by ID",
 *     tags={"Clients"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the client",
 *         @OA\Schema(type="integer")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="id",
 *                 type="integer",
 *                 example="1"
 *             ),
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="John Doe"
 *             ),
 *             @OA\Property(
 *                 property="address",
 *                 type="string",
 *                 example="123 Main St"
 *             ),
 *             @OA\Property(
 *                 property="phone",
 *                 type="string",
 *                 example="555-123-4567"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 example="john@example.com"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Client not found"
 *     )
 * )
 */
public function show($id)
{
    auth()->user()->hasPermiso('leer');

    try {
        // Cargar la relación 'servicio' utilizando 'with'
        $client = Clientes::with('servicio')->find($id);

        if (!$client) {
            return response()->json(['message' => 'Client not found'], 404);
        }

        return new ClienteResource($client);
    } catch (\Throwable $th) {
        throw new SomethingWentWrong($th);
    }
}



/**
 * Update the specified client in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @param  \App\Models\Clientes  $cliente
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Put(
 *     path="/api/clientes/{cliente}/update",
 *     summary="Update a client",
 *     tags={"Clients"},
 *     @OA\Parameter(
 *         name="cliente",
 *         in="path",
 *         description="ID of the client to update",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"nombre", "address", "phone", "email"},
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="John Doe"
 *             ),
 *             @OA\Property(
 *                 property="address",
 *                 type="string",
 *                 example="123 Main St"
 *             ),
 *             @OA\Property(
 *                 property="phone",
 *                 type="string",
 *                 example="555-123-4567"
 *             ),
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 example="john@example.com"
 *             ),
 *            @OA\Property(
 *                 property="servicios_id",
 *                 type="id",
 *                 example="1"
 *             )
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Client updated successfully"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Unprocessable Entity"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Client not found"
 *     )
 * )
 */


public function update(Request $request, Clientes $cliente)
{

    auth()->user()->hasPermiso('editar');

    $request->validate([
        "nombre" => "required",
    ]);
    try{
        Cache::forget('clientes_index');
        $cliente->nombre = $request->nombre;
        $cliente->servicios_id = $request->servicios_id;
        $cliente->address = $request->address;
        $cliente->phone = $request->phone;
        $cliente->email = $request->email;
        $cliente->save();

        return new ClienteResource($cliente);
    }catch(\Throwable $th){

        throw new SomethingWentWrong($th);
    }


}

/**
 * Remove the specified client from storage.
 *
 * @param  \App\Models\Clientes  $cliente
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Delete(
 *     path="/api/clientes/{cliente}",
 *     summary="Delete a client",
 *     tags={"Clients"},
 *     @OA\Parameter(
 *         name="cliente",
 *         in="path",
 *         description="ID of the client to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Client deleted successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Client not found"
 *     )
 * )
 */
public function destroy(Clientes $cliente)
{
    auth()->user()->hasPermiso('borrar');

    try{
        $cliente->delete();
        return response()->json(["message" => "Client deleted successfully"]);
    }catch(\Throwable $th){

        throw new SomethingWentWrong($th);
    }

}


}

