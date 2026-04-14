<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
 
class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name'     => 'Admin User',
            'email'    => 'admin@bughive.dev',
            'password' => Hash::make('password'),
            'role'     => 'admin',
        ]);
 
        // Developer users
        $developers = [
            ['name' => 'Maria Santos',  'email' => 'maria@bughive.dev'],
            ['name' => 'James Reyes',   'email' => 'james@bughive.dev'],
            ['name' => 'Ana Cruz',      'email' => 'ana@bughive.dev'],
            ['name' => 'Carlos Mendez', 'email' => 'carlos@bughive.dev'],
        ];
 
        foreach ($developers as $dev) {
            User::create([
                ...$dev,
                'password' => Hash::make('password'),
                'role'     => 'developer',
            ]);
        }
    }
}
    
