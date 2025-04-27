<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'nom' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'), // Hacher le mot de passe
            'role' => 'admin',
            'id_service' => 1, // Id du service correspondant
            'is_validator' => true,
            'status' => 'actif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
