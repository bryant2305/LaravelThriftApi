<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\DepartamentoController;
use Illuminate\Database\Seeder;
use App\Models\moduloss;
use App\Models\Modulos;


class ModuloSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $modulos = new Modulos();
       $modulos -> nombre = 'Clientes';
       $modulos -> descripcion = 'Modulo clientes';
       $modulos ->save();

       $modulos = new Modulos();
       $modulos -> nombre = 'Servicios';
       $modulos -> descripcion = 'Modulo servicios';
       $modulos ->save();

       $modulos = new Modulos();
       $modulos -> nombre = 'Encargados';
       $modulos -> descripcion = 'Modulos encargados';
       $modulos ->save();


    }
}
