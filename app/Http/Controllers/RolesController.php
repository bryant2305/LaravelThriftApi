<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Http\Resources\RolesResource;
use App\Exceptions\SomethingWentWrong;
use App\Exceptions\NotPermissions;

class RolesController extends Controller
{
    /**
     * @OA\Get(
     *     tags={"Roles"},
     *     path="/api/roles",
     *     summary="Get a listing of the Roles",
     *     @OA\Parameter(
     *         name="nombre",
     *         in="query",
     *         description="Filter by a role name",
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
        try {
            $user = auth()->user();

            if ($user && $user->hasPermiso('leer')) {
                $nombre = $request->query('nombre');
                $paginacion = $request->query('paginacion');

                $roles = Role::nombre($nombre, $paginacion);

                return RolesResource::collection($roles);
            } else {
                throw new NotPermissions();
            }
        } catch (\Throwable $th) {
            throw new SomethingWentWrong($th);
        }
    }
}
