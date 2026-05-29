<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsuariosSeeder extends Seeder
{
    
    public function run(): void
    {
        User::create([
            'nombre_completo' => 'Administrador Principal',
            'email' => 'admin@empresa.com',
            'password' => Hash::make('12345678'),
            'email_verified_at' => now(),
        ]);

        User::create([
            'nombre_completo' => 'Soporte Ventas',
            'email' => 'soporte@empresa.com',
            'password' => Hash::make('password123'),
            'email_verified_at' => now(),
        ]);
    }
}
