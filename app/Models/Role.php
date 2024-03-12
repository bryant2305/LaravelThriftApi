<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;



    public function permisos()
    {
        return $this->belongsToMany(Permisos::class, 'role_permisos', 'role_id', 'permiso_id');
    }

    public function user()
    {
        return $this->belongsToMany(User::class, 'role_users', 'role_id', 'user_id');
    }

    public function scopeNombre($query, $nombre = null, $paginacion = null)
    {
        if (!empty($nombre)) {
            $query->where('nombre', 'like', '%' . $nombre . '%');
        }

        return $query->paginate($paginacion ?? env('PAGINAR'));
    }
}
