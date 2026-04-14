<?php
namespace App\Policies;
 
use App\Models\Bug;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
 
class BugPolicy
{
    use HandlesAuthorization;
 
    public function viewAny(User $user): bool
    {
        return true; // All authenticated users can list bugs
    }
 
    public function view(User $user, Bug $bug): bool
    {
        return $user->role === 'admin'
            || $bug->reporter_id === $user->id
            || $bug->assignee_id === $user->id
            || $bug->project->members()->where('user_id', $user->id)->exists()
            || $bug->project->is_public;
    }
 
    public function create(User $user): bool
    {
        return true; // Any authenticated user can report a bug
    }
 
    public function update(User $user, Bug $bug): bool
    {
        return $user->role === 'admin'
            || $bug->reporter_id === $user->id
            || $bug->assignee_id === $user->id;
    }
 
    public function delete(User $user, Bug $bug): bool
    {
        return $user->role === 'admin' || $bug->reporter_id === $user->id;
    }
}