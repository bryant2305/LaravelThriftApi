<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HealthCheckController extends Controller
{
 /**
 * @OA\Get(
 *     path="/api/ping",
 *     summary="health`s check",
 *     tags={"HealthCheck"},
 *     @OA\Response(
 *         response=200,
 *         description="Solicitud exitosa",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="pong!!"
 *             )
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Error interno del servidor"
 *     )
 * )
 */
public function ping()
{
    try {
        return response()->json(['message' => 'pong!!'], 200);
    } catch (\Throwable $th) {
        throw new SomethingWentWrong($th);
    }
}
}
