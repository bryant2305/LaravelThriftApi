<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;

use App\Exceptions\SomethingWentWrong;

class UserController extends Controller
{


// // /**
// //  * @OA\Post(
// //  *     path="/api/asignar-rol/store",
// //  *     summary="Asignar un rol a un usuario",
// //  *     tags={"Usuarios"},
// //  *     @OA\RequestBody(
// //  *         required=true,
// //  *         @OA\JsonContent(
// //  *             @OA\Property(property="usuario_id", type="integer", format="int64", description="ID del usuario"),
// //  *             @OA\Property(property="rol", type="integer", description="id del rol a asignar")
// //  *         )
// //  *     ),
// //  *     @OA\Response(response=200, description="Rol asignado con éxito"),
// //  *     @OA\Response(response=404, description="Usuario no encontrado"),
// //  * )
// //  */



    public function asignarRol(Request $request)
    {

           auth()->user()->hasPermiso('asignar_rol');

            try {

                $usuario_id = $request->input('usuario_id');
                $rol_id = $request->input('rol_id');


                $usuario = User::find($usuario_id);
                if (!$usuario) {
                    return response()->json(['message' => 'Usuario no encontrado'], 404);
                }
                $rol = Role::find($rol_id);
                if (!$rol) {
                    return response()->json(['message' => 'Rol no encontrado'], 404);
                }


                $usuario->roles()->attach($rol);


                return response()->json(['message' => 'Rol asignado con éxito'], 200);

            } catch (\Throwable $th) {

                throw new SomethingWentWrong($th);
            }
        }


}

