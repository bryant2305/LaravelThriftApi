<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Encargado;
use App\Http\Resources\EncargadoResource;
use App\Exceptions\SomethingWentWrong;

class EncargadoController extends Controller
{

     /**
     * @OA\Get(
     *     tags={"Encargado"},
     *     path="/api/encargados",
     *     security={{"bearerAuth":{}}},
     *     summary="Get a listing of the encargado",
     *     @OA\Parameter(
     *         name="apellido",
     *         in="query",
     *         description="Filter by encargado apellido",
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


    public function index( Request $request)
    {
        try{
            auth()->user()->hasPermiso('leer');

            $apellido = $request->query('apellido');
            $paginacion = $request->query('paginacion');

            $encargado = Encargado::apellido($apellido, $paginacion);

            return  EncargadoResource::collection($encargado);
        }
        catch(\Throwable $th){
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
 *     tags={"Encargado"},
 *     path="/api/encargados/store",
 *     security={{"bearerAuth":{}}},
 *     summary="Create a new encargado",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"nombre"},
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="John Doe"
 *             ),
 *             @OA\Property(
 *                 property="apellido",
 *                 type="string",
 *                 example="perez"
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
            "apellido"=>'required',
        ]);

        try{

            $encargado = new Encargado();
            $encargado->nombre = $request->nombre;
            $encargado -> apellido = $request->apellido;
            $encargado->save();

            $data = [
                "message" => "encargado created successfully",
                "client" => $encargado
            ];
            return new EncargadoResource($encargado);
        }catch(\Throwable $th){

            throw new SomethingWentWrong($th);
        }
    }

      /**
 * Display the specified client.
 *
 * @param  int  $id
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Get(
 *     tags={"Encargado"},
 *     path="/api/encargados/{id}/show",
 *     security={{"bearerAuth":{}}},
 *     summary="Get a specific client by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the encargado",
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
 *                 property="apellido",
 *                 type="string",
 *                 example="perez"
 *             ),
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="encargado not found"
 *     )
 * )
 */
    public function show( $id)
    {
        auth()->user()->hasPermiso('leer');

        try {
            $encargado = Encargado::find($id);

        if ($encargado == null){
             return response()->json("error , no se encontro ningun servicio");
        }
            return new EncargadoResource($encargado);
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }

    }

    /**
 *
 * @OA\Put(
 *     path="/api/encargados/{encargado}/update",
 *     security={{"bearerAuth":{}}},
 *     summary="Update a client",
 *     tags={"Encargado"},
 *     @OA\Parameter(
 *         name="encargado",
 *         in="path",
 *         description="ID of the encargado to update",
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
 *             required={"nombre"},
 *             @OA\Property(
 *                 property="nombre",
 *                 type="string",
 *                 example="John Doe"
 *             ),
 *             @OA\Property(
 *                 property="apellido",
 *                 type="string",
 *                 example="123 Main St"
 *             ),
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
    public function update(Request $request, Encargado $encargado)
    {

        auth()->user()->hasPermiso('editar');

        $request->validate([
        "nombre" => "required",
       ]);

       try{
        $encargado->nombre = $request->nombre;
        $encargado->apellido = $request->apellido;
        $encargado->save();

        return new EncargadoResource($encargado);

    }catch(\Throwable $th){

        throw new SomethingWentWrong($th);
    }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
