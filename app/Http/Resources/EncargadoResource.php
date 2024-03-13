<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EncargadoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "encargado" => [
                "id" => $this->id,
                "nombre" => $this->nombre ?? null,
                "apellido" => $this->apellido ?? null,
                "clientes" => $this->clientes->map(function ($cliente) {
                    return [
                        "id" => $cliente->id,
                        "nombre" => $cliente->nombre ?? null,
                    ];
                }),
            ]
        ];
    }
}
