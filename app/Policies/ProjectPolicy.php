<?php

namespace App\Policies;
 
use App\Models\Project;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
 
class ProjectPolicy
{
    use HandlesAuthorization;
 
    public function viewAny(User $user): bool
    {
        return true;
    }
 
    public function view(User $user, Project $project): bool
    {
        return $project->is_public
            || $project->owner_id === $user->id
            || $user->role === 'admin'
            || $project->members()->where('user_id', $user->id)->exists()
            || $project->bugs()->where('assignee_id', $user->id)->exists();
    }
 
    public function create(User $user): bool
    {
        return true;
    }
 
    public function delete(User $user, Project $project): bool
    {
        return $user->role === 'admin' || $project->owner_id === $user->id;
    }

    public function update(User $user, Project $project): bool
    {
        return $user->role === 'admin';
    }
}
