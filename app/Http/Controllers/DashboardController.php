<?php
namespace App\Http\Controllers;
 
use App\Models\Bug;
use Inertia\Inertia;
use Inertia\Response;
 
class DashboardController extends Controller
{
    public function index(): Response
    {
        $user = auth()->user();
 
        $recentBugs = Bug::with(['status', 'assignee', 'project'])
            ->orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
 
        $myBugs = Bug::with(['status', 'project'])
            ->where('assignee_id', $user->id)
            ->whereHas('status', fn($q) => $q->whereNotIn('name', ['Resolved', 'Closed']))
            ->orderBy('created_at', 'desc')
            ->limit(8)
            ->get();
 
        return Inertia::render('Dashboard', [
            'recentBugs' => $recentBugs,
            'myBugs'     => $myBugs,
            'user'       => $user->only('id', 'name', 'email', 'role'),
        ]);
    }
}