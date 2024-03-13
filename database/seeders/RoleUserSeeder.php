<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RoleUser;
use App\Models\RolePermiso;
use App\Models\Modulos;
use App\Models\Permisos;


class RoleUserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        #1
        $roleuser = new RoleUser();
        $roleuser->user_id = 1;
        $roleuser->role_id = 1;
        $roleuser->save();

    }
}
