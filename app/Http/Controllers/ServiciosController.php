<?php

namespace App\Http\Controllers;

use App\Models\Servicios;
use Illuminate\Http\Request;

class ServiciosController extends Controller
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @OA\Get(
     *     path="/api/servicios",
     *     summary="Get all servicios",
     *     tags={"Services"},
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
    public function index()
    {
        $servicios = Servicios::all();
        return response()->json($servicios);
    }

 /**
 * Store a newly created client in storage.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 *
 * @OA\Post(
 *     path="/api/servicios/store",
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
       $request->validate([
        "nombre" => "required"
       ]);

       $servicios = new Servicios();
       $servicios -> nombre = $request ->nombre;
       $servicios -> precio = $request ->precio;
       $servicios ->save();

       $data = [
        "message" => "Service created successfully",
        "service" => $servicios
    ];

    return response()->json($data);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
