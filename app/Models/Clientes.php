<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    use HasFactory;

    public function servicios()
{
    return $this->hasMany(Servicios::class, 'cliente_id', 'id');
}

}
