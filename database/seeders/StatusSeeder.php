<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Status;
use Illuminate\Database\Seeder;
 
class StatusSeeder extends Seeder
{
    public function run(): void
    {
        $statuses = [
            ['name' => 'Open',        'color' => '#3B82F6', 'order' => 1],
            ['name' => 'In Progress', 'color' => '#F59E0B', 'order' => 2],
            ['name' => 'In Review',   'color' => '#8B5CF6', 'order' => 3],
            ['name' => 'Resolved',    'color' => '#10B981', 'order' => 4],
            ['name' => 'Closed',      'color' => '#6B7280', 'order' => 5],
            ["name" => "Won't Fix",   'color' => '#EF4444', 'order' => 6],
        ];
 
        foreach ($statuses as $status) {
            Status::create($status);
        }
    }
}
