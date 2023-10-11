<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;


    public function scopeNombre($query, $nombre = null, $paginacion = null)
    {
        if (!empty($nombre)) {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }

        return $query->paginate($paginacion ?? env('PAGINAR'));
    }
    // Debe coincidir con el nombre de la relación en el modelo Clientes
    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'servicios_id', 'id');
    }

}
