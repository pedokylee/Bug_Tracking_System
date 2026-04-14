<?php

namespace App\Http\Middleware;

use App\Models\Project;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class EnsureProjectAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $project = $request->route('project');
 
        if (!$project) {
            return $next($request);
        }
 
        $user = $request->user();
 
        // Admin has full access
        if ($user->role === 'admin') {
            return $next($request);
        }
 
        // Check if user is a project member or owner
        $hasAccess = $project->owner_id === $user->id
            || $project->members()->where('user_id', $user->id)->exists()
            || $project->is_public;
 
        if (!$hasAccess) {
            abort(403, 'You do not have access to this project.');
        }
 
        return $next($request);
    }
}
