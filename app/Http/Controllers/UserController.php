<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Http\Resources\UserResource;

use App\Exceptions\SomethingWentWrong;

class UserController extends Controller
{


/**
 * @OA\Post(
 *     path="/api/users/asignar-rol",
 *     summary="Assign a role to a user ",
 *     security={{"bearerAuth":{}}},
 *     tags={"Users"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="usuario_id", type="integer", format="int64", description="ID del usuario"),
 *             @OA\Property(property="role_id", type="integer", description="id del rol a asignar")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Rol asignado con éxito"),
 *     @OA\Response(response=404, description="Usuario no encontrado"),
 * )
 */



 public function asignarRol(Request $request)
 {
     auth()->user()->hasPermiso('asignar_rol');

     try {
         $usuario_id = $request->input('usuario_id');
         $role_id = $request->input('role_id');

         $usuario = User::find($usuario_id);
         if (!$usuario) {
             return response()->json(['message' => 'Usuario no encontrado'], 404);
         }
         $role = Role::find($role_id);
         if (!$role) {
             return response()->json(['message' => 'Rol no encontrado'], 404);
         }

         $usuario->roles()->attach($role);

         return response()->json(['message' => 'Rol asignado con éxito'], 200);

     } catch (\Throwable $th) {
         throw new SomethingWentWrong($th);
     }
 }

 /**
     * @OA\Get(
     *     tags={"Users"},
     *     path="/api/users",
     *     security={{"bearerAuth":{}}},
     *     summary="Get a listing of the users",
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         description="Filter by users name",
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

        $name = $request->query('name');
        $paginacion = $request->query('paginacion');
        $users = User::name($name, $paginacion);

        return UserResource::collection($users);
    } catch (\Throwable $th) {
        throw new SomethingWentWrong($th);
    }
}


}
