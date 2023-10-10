<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;

    // Debe coincidir con el nombre de la relación en el modelo Clientes
    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'servicios_id', 'id');
    }
}
