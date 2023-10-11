<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    // Debe coincidir con el nombre de la relación en el modelo Servicios
    public function scopeNombre($query, $nombre = null, $paginacion = null)
    {
        if (!empty($nombre)) {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }

        return $query->paginate($paginacion ?? env('PAGINAR'));
    }
    public function servicio()
    {
        return $this->belongsTo(Servicios::class, 'servicios_id');
    }

    public function encargado()
    {
        return $this->belongsTo(Encargado::class, 'encargado_id');
    }

}
