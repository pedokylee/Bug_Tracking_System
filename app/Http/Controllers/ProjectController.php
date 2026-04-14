<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    public function index(): Response
    {
        $projects = Project::withCount('bugs')
            ->with('owner')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return Inertia::render('Projects/Index', [
            'projects' => $projects,
        ]);
    }

    public function create(): Response
    {
        $this->authorize('create', Project::class);

        return Inertia::render('Projects/Create');
    }

    public function store(StoreProjectRequest $request)
    {
        $this->authorize('create', Project::class);

        $project = Project::create([
            ...$request->validated(),
            'owner_id' => auth()->id(),
        ]);

        return redirect()
            ->route('projects.show', $project)
            ->with('success', 'Project created successfully.');
    }

    public function show(Project $project): Response
    {
        $this->authorize('view', $project);

        $project->load(['bugs.status', 'bugs.assignee', 'owner']);

        $stats = [
            'total'       => $project->bugs->count(),
            'open'        => $project->bugs->where('status.name', 'Open')->count(),
            'in_progress' => $project->bugs->where('status.name', 'In Progress')->count(),
            'resolved'    => $project->bugs->where('status.name', 'Resolved')->count(),
        ];

        return Inertia::render('Projects/Show', [
            'project' => $project,
            'stats'   => $stats,
        ]);
    }

    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Project deleted.');
    }
}