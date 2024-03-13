<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\DepartamentoController;
use Illuminate\Database\Seeder;
use App\Models\Servicios;
use App\Models\Permisos;


class PermisoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $servicio = new Permisos();
       $servicio -> nombre = 'leer';
       $servicio -> descripcion = 'Leer';
       $servicio ->save();

       $servicio = new Permisos();
       $servicio -> nombre = 'crear';
       $servicio -> descripcion = 'Creae';
       $servicio ->save();

       $servicio = new Permisos();
       $servicio -> nombre = 'editar';
       $servicio -> descripcion = 'Editar';
       $servicio ->save();

       $servicio = new Permisos();
       $servicio -> nombre = 'borrar';
       $servicio -> descripcion = 'borrar';
       $servicio ->save();

       $servicio = new Permisos();
       $servicio -> nombre = 'asignar_rol';
       $servicio -> descripcion = 'asignar rol';
       $servicio ->save();

    }
}
