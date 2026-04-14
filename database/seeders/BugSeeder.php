<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Bug;
use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use Illuminate\Database\Seeder;
 
class BugSeeder extends Seeder
{
    public function run(): void
    {
        $projects  = Project::all();
        $statuses  = Status::all()->keyBy('name');
        $users     = User::all();
 
        $bugs = [
            [
                'title'       => 'Payment gateway timeout on checkout',
                'description' => 'Users experience a 30-second timeout when completing payment. Stripe webhook fails to respond.',
                'priority'    => 'critical',
                'status'      => 'Open',
                'environment' => 'Production',
            ],
            [
                'title'       => 'Cart total incorrect with discount codes',
                'description' => 'When applying a percentage discount code, the cart total displays incorrectly.',
                'priority'    => 'high',
                'status'      => 'In Progress',
                'environment' => 'Staging',
            ],
            [
                'title'       => 'Product images not loading on mobile',
                'description' => 'WebP images fail to load on Safari iOS. PNG fallback not implemented.',
                'priority'    => 'medium',
                'status'      => 'In Review',
                'environment' => 'Production',
            ],
            [
                'title'       => 'Search filter resets on page refresh',
                'description' => 'Applied search filters are lost when the user refreshes the product listing page.',
                'priority'    => 'low',
                'status'      => 'Resolved',
                'environment' => 'Production',
            ],
            [
                'title'       => 'Login session expires too quickly',
                'description' => 'Users are logged out after 15 minutes of inactivity instead of the configured 2 hours.',
                'priority'    => 'high',
                'status'      => 'Open',
                'environment' => 'Production',
            ],
            [
                'title'       => 'Dashboard charts not rendering on Firefox',
                'description' => 'Chart.js components fail to initialize in Firefox 119+. Console shows canvas error.',
                'priority'    => 'medium',
                'status'      => 'In Progress',
                'environment' => 'All browsers',
            ],
        ];
 
        foreach ($bugs as $i => $bugData) {
            $project = $projects[$i % $projects->count()];
            $reporter = $users->random();
            $assignee = $users->random();
 
            Bug::create([
                'title'        => $bugData['title'],
                'description'  => $bugData['description'],
                'priority'     => $bugData['priority'],
                'status_id'    => $statuses[$bugData['status']]->id,
                'project_id'   => $project->id,
                'reporter_id'  => $reporter->id,
                'assignee_id'  => $assignee->id,
                'environment'  => $bugData['environment'],
            ]);
        }
    }
}
