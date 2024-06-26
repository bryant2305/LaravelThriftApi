<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    use HasFactory;

    public function scopeApellido($query, $apellido = null, $paginacion = null)
    {
        if (!empty($apellido)) {
            $query->where('apellido', 'like', '%' . $apellido . '%');
        }

        if ($paginacion !== null) {
            return $query->paginate($paginacion);
        }

        return $query->get();
    }

    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'encargado_id');
    }

}
