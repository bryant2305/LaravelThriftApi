<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicios extends Model
{
    use HasFactory;

    public function clientes(){
        return $this->belongsTo(Clientes::class, 'cliente_id', 'id');
    }
}
