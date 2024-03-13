<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;
use App\Http\Resources\ServiceResource;
use App\Exceptions\SomethingWentWrong;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     tags={"Services"},
     *     path="/api/servicios",
     *     security={{"bearerAuth":{}}},
     *     summary="Get all servicios",
     * @OA\Parameter(
     *         name="nombre",
     *         in="query",
     *         description="Filter by service name",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         )
     * ),
     * @OA\Parameter(
     *         name="paginacion",
     *         in="query",
     *         description="paginacion",
     *         required=false,
     *         @OA\Schema(
     *             type="interger"
     *         )
     * ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(
     *             @OA\Schema(
     *              type="string",
     *              format="string",
     *              example="tecnologia",
     *          )
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
        $user = auth()->user();

        try{
            if ($user && $user->hasPermiso('leer'))
               /// $nombre = $request->query('nombre');
                $paginacion = $request->query('paginacion');

                $servicio = Servicios::nombre($nombre, $paginacion);

                return ServiceResource::collection($servicio);

        }catch (\Throwable $th) {
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
 *     path="/api/servicios/store",
 *     security={{"bearerAuth":{}}},
 *     summary="Create a new service",
 *     tags={"Services"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"nombre", "precio"},
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="mantenimiento"
 *             ),
 *             @OA\Property(
 *                 property="precio",
 *                 type="string",
 *                 example="100000"
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
        "nombre" => "required"
       ]);

       try{

           $servicios = new Servicios();
           $servicios -> nombre = $request ->nombre;
           $servicios -> precio = $request ->precio;
           $servicios ->save();

       }catch(\Throwable $th){

        throw new SomethingWentWrong($th);
       }


    }

     /**
 * Display the specified service.
 *
 * @param  int  $id
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Get(
 *     path="/api/servicios/{id}/show",
 *     security={{"bearerAuth":{}}},
 *     summary="Get a specific service by ID",
 *     tags={"Services"},
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the service",
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
 *                 example="servicio"
 *             ),
 *             @OA\Property(
 *                 property="precio",
 *                 type="string",
 *                 example="10000"
 *             ),
 *
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Client not found"
 *     )
 * )
 */
    public function show( int $id)
    {

        auth()->user()->hasPermiso('leer');

        try{
            $servicios = Servicios::find($id);

            if ($servicios == null){
                 return response()->json("error , no se encontro ningun servicio");
            }

            return new ServiceResource($servicios);

        }catch(\Throwable $th){

            throw new SomethingWentWrong($th);

        }
    }

    /**
 * Update a newly created client in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Put(
 *     path="/api/servicios/{servicio}/update",
 *     security={{"bearerAuth":{}}},
 *     summary="update a new service",
 *     tags={"Services"},
 *
 *  @OA\Parameter(
 *         name="servicio",
 *         in="path",
 *         description="ID of the service to update",
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
 *             required={"nombre", "precio"},
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="mantenimiento"
 *             ),
 *             @OA\Property(
 *                 property="precio",
 *                 type="string",
 *                 example="100000"
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
public function update(Request $request, Servicios $servicio)
{

    auth()->user()->hasPermiso('editar');

    try{
        if (!$servicio) {
            return response()->json(["message" => "Service not found"], 404);
        }

        $servicio->nombre = $request->nombre;
        $servicio->precio = $request->precio;
        $servicio->save();

        return new  ServiceResource($servicio);

    }catch (\Throwable $th) {
        throw new SomethingWentWrong($th);
    }

}

    /**
 * Remove the specified service from storage.
 *
 * @param  \App\Models\Servicios  $servicio
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Delete(
 *     path="/api/servicios/{servicio}",
 *     security={{"bearerAuth":{}}},
 *     summary="Delete a service",
 *     tags={"Services"},
 *     @OA\Parameter(
 *         name="servicio",
 *         in="path",
 *         description="ID of the service to delete",
 *         required=true,
 *         @OA\Schema(
 *             type="integer",
 *             format="int64"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Service deleted successfully"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Service not found"
 *     )
 * )
 */
public function destroy(Servicios $servicio)
{
    auth()->user()->hasPermiso('borrar');

    try {
        $servicio->delete();
        return response()->json('Service deleted successfully');
    } catch (\Throwable $th) {
        throw new SomethingWentWrong($th);
    }
}

}
