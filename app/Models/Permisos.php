<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permisos extends Model
{
    use HasFactory;

    public function roles()
{
    return $this->belongsToMany(Role::class, 'role_permisos', 'permiso_id', 'role_id');
}

}
