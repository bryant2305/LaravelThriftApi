<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\DepartamentoController;
use Illuminate\Database\Seeder;
use App\Models\Encargado;

class EncargadoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       $servicio = new Encargado();
       $servicio -> nombre = 'Lavador jonh';
       $servicio -> apellido = 'Garcia';
       $servicio ->save();

    }
}
