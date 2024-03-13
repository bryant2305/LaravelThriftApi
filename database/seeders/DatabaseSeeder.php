<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\DepartamentoController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // $this->call(ClientSeeder::class);
        // $this->call(ServiceSeeder::class);
        // $this->call(EmpleadoSeeder::class);
        // $this->call(DepartamentoSeeder::class);

        $this->call(ServicioSeeder::class);
        $this->call(ModuloSeeder::class);
        $this->call(PermisoSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(EncargadoSeeder::class);
    }
}
