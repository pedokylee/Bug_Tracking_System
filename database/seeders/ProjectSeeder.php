<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Seeder;
 
class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('email', 'admin@bughive.dev')->first();
 
        $projects = [
            [
                'name'        => 'E-Commerce Platform',
                'description' => 'Online store with payment integration and inventory management.',
                'is_public'   => true,
            ],
            [
                'name'        => 'Mobile Banking App',
                'description' => 'Secure banking application for iOS and Android.',
                'is_public'   => false,
            ],
            [
                'name'        => 'CRM Dashboard',
                'description' => 'Customer relationship management tool for sales teams.',
                'is_public'   => false,
            ],
        ];
 
        foreach ($projects as $project) {
            Project::create([
                ...$project,
                'owner_id' => $admin->id,
            ]);
        }
    }
}
