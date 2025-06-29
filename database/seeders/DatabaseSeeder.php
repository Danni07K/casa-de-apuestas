<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Crear usuario administrador
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tecbet.com',
            'phone' => '123456789',
            'birthdate' => '1990-01-01',
            'password' => Hash::make('12345678'),
            'role' => 'admin',
            'balance' => 1000.00,
        ]);

        // Crear usuario normal
        User::create([
            'name' => 'Usuario',
            'email' => 'user@tecbet.com',
            'phone' => '987654321',
            'birthdate' => '1995-01-01',
            'password' => Hash::make('12345678'),
            'role' => 'user',
            'balance' => 100.00,
        ]);

        $this->call([
            EventSeeder::class,
        ]);
    }
}
