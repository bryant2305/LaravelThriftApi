<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\DepartamentoController;
use Illuminate\Database\Seeder;
use App\Models\Servicios;

class ServicioSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $servicio = new Servicios();
       $servicio -> nombre = 'mantenimiento electrico';
       $servicio -> precio = '$700';
       $servicio ->save();

       $servicio = new Servicios();
       $servicio -> nombre = 'limpieza de vehiculo';
       $servicio -> precio = '$250';
       $servicio ->save();

       $servicio = new Servicios();
       $servicio -> nombre = 'lavado de ropa';
       $servicio -> precio = '$300';
       $servicio ->save();

       $servicio = new Servicios();
       $servicio -> nombre = 'limpieza de casa';
       $servicio -> precio = '$1000';
       $servicio ->save();

    }
}
