<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Client extends Model
{
    use HasFactory;

    public function services()
    {
        return $this->belongsToMany(Service::class,'clients_services');
    }


    // protected function name () : Attribute

    // {
    //     return new Attribute(

    //         set: function($value){
    //             return strtolower($value);
    //         }
    //     );

    // }

}
