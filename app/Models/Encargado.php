<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encargado extends Model
{
    use HasFactory;

    public function clientes()
    {
        return $this->hasMany(Clientes::class, 'encargado_id');
    }

}
