<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria um usuário administrador padrão
        User::firstOrCreate(
            ['email' => 'admin@paulinho.com'],
            [
                'name' => 'Administrador',
                'email' => 'admin@paulinho.com',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );

        // Cria um usuário do Paulinho
        User::firstOrCreate(
            ['email' => 'paulinho@gmail.com'],
            [
                'name' => 'Paulinho Polimentos',
                'email' => 'paulinho@gmail.com',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );

        // Cria um usuário da Elisa
        User::firstOrCreate(
            ['email' => 'elisa@gmail.com'],
            [
                'name' => 'Elisa Car-Detail',
                'email' => 'elisa@gmail.com',
                'password' => Hash::make('123456'),
                'email_verified_at' => now(),
            ]
        );
    }
}
