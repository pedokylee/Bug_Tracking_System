<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use App\Models\Bug;
use App\Models\Project;
use App\Models\Comment;
use App\Policies\BugPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\CommentPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        // Register authorization policies
        Gate::policy(Bug::class, BugPolicy::class);
        Gate::policy(Project::class, ProjectPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
    }
}
