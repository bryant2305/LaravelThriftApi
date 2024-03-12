<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\RolePermiso;
use App\Models\Modulos;
use App\Models\Permisos;


class RoleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        #1
        $role1 = new Role();
        $role1->nombre = "Administrador";
        $role1->descripcion = "Admin del Sistema";
        $role1->save();

        foreach (Permisos::all() as $permiso) {
            if ($permiso->id <=5) { // Sin Permiso de evaluar
                $rp = new RolePermiso();
                $rp->role_id = $role1->id;
                $rp->permiso_id = $permiso->id;
                $rp->save();
            }
        }

         #2
         $role2 = new Role();
         $role2->nombre = "Usuario";
         $role2->descripcion = "Usuario normal";
         $role2->save();

         foreach (Permisos::all() as $permiso) {
             if ($permiso->id == 1 ) { // Sin Permiso de evaluar
                 $rp = new RolePermiso();
                 $rp->role_id = $role2->id;
                 $rp->permiso_id = $permiso->id;
                 $rp->save();
             }
         }


        // foreach (Modulos::all() as $modulo) {
        //     if ($modulo->id >= 3 &&  $modulo->id <= 15) { //Modulos de Convocatorias
        //         $rm = new RoleModulo();
        //         $rm->role_id = $role2->id;
        //         $rm->modulo_id = $modulo->id;
        //         $rm->save();
        //     }
        // }

    }
}
