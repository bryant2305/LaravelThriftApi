<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\HasApiTokens;
use App\Http\Resources\UserResource;
/**
 * @group Authentication
 *
 * APIs for user authentication
 */
class AuthController extends Controller
{
    use HasApiTokens;

   /**
 * @OA\Post(
 *     path="/api/register",
 *     summary="Registro de usuarios",
 *     tags={"Autenticacion"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "email", "password"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", format="email", example="johndoe@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="secretpassword"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Usuario registrado exitosamente",
 *         @OA\JsonContent(
 *             @OA\Property(property="token", type="string", description="Token de acceso generado para el usuario"),
 *         ),
 *     ),
 *     @OA\Response(
 *         response=400,
 *         description="Error de validación",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", description="Mensaje de error"),
 *             @OA\Property(property="errors", type="object", description="Errores de validación"),
 *         ),
 *     ),
 * )
 */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => $validator->errors()], 422);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        $user->roles()->attach(2);
        $token = $user->createToken('MyAppToken')->plainTextToken;

        return response()->json(['user' => $user, 'token' => $token], 200);
    }

    /**
 * @OA\Post(
 *     path="/api/login",
 *     summary="Iniciar sesión de usuario",
 *     tags={"Autenticacion"},
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *             @OA\Property(property="email", type="string", format="email", example="pruebaAdmin@pruebas.com"),
 *             @OA\Property(property="password", type="string", format="password", example="admin")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Inicio de sesión exitoso",
 *         @OA\JsonContent(
 *             @OA\Property(property="token", type="string", example="aqui_va_el_token_de_acceso")
 *         )
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="No autorizado",
 *         @OA\JsonContent(
 *             @OA\Property(property="message", type="string", example="Credenciales inválidas")
 *         )
 *     )
 * )
 */


 public function login(Request $request)
 {
     $credentials = $request->only('email', 'password');

     if (Auth::attempt($credentials)) {
         $user = Auth::user();
         $token = $user->createToken('MyAppToken')->plainTextToken;

         // Devolver el recurso UserResource junto con el token
         return response()->json([
             'user' => new UserResource($user),
             'token' => $token
         ], 200);
     } else {
         return response()->json(['message' => 'Credenciales inválidas'], 401);
     }
 }


    /**
     * Log out the currently authenticated user.
     *
     * @authenticated
     *
     * @response 200 {
     *   "message": "Logged out successfully."
     * }
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        $user = Auth::user();
        $user->tokens->each(function ($token, $key) {
            $token->delete();
        });

        return response()->json(['message' => 'Logged out successfully'], 200);
    }
}
