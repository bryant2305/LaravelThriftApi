<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EncargadoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "encargado"=>[
                "nombre"=> $this->nombre,
                 "apellido"=> $this->apellido,
                 "cliente" => $this->clientes
            ]
        ];
    }
}
