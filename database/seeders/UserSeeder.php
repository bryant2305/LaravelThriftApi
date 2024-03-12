<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Http\Controllers\DepartamentoController;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = new User();
        $user->name ='admin';
        $user->role_id = 1; // Admin
        $user->email = env('DEFAULT_USER_EMAIL');
        $user->password = bcrypt(env('DEFAULT_USER_PASS'));
        $user->save();

    }
}
