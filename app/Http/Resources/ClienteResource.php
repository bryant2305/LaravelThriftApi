<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            "nombre"=> $this->nombre,
             "email"=>$this->email,
             "address"=>$this->address,
             "phone"=>$this->phone,
             "servicio" => $this->servicios ? [
                "nombre" => $this->servicios->first() ? $this->servicios->first()->nombre : null,
            ] : null,



        ];
    }
}
