<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "nombre" => $this->nombre,
            "email" => $this->email,
            "address" => $this->address,
            "phone" => $this->phone,
            "servicio_id" => $this->servicios_id,
            "servicio" => new ServiceResource($this->servicio),
            "encargado" => new EncargadoResource($this->encargado),
        ];
    }
}
