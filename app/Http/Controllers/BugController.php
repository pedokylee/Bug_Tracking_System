<?php

namespace App\Http\Controllers;

use App\Models\Bug;
use App\Models\Project;
use App\Models\Status;
use App\Models\User;
use App\Http\Requests\StoreBugRequest;
use App\Http\Requests\UpdateBugRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BugController extends Controller
{
    /**
     * Display a listing of all bugs for a project.
     */
    public function index(Project $project): Response
    {
        $this->authorize('view', $project);

        $bugs = $project->bugs()
            ->with(['status', 'assignee', 'reporter'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);

        $statuses = Status::all();

        return Inertia::render('Bugs/Index', [
            'project' => $project,
            'bugs'    => $bugs,
            'statuses' => $statuses,
            'filters' => request()->only(['search', 'status', 'priority']),
        ]);
    }

    /**
     * Show the form for creating a new bug.
     */
    public function create(Project $project): Response
    {
        $this->authorize('create', Bug::class);

        return Inertia::render('Bugs/Create', [
            'project'  => $project,
            'statuses' => Status::all(),
            'users'    => User::select('id', 'name', 'email')->get(),
            'priorities' => Bug::getPriorities(),
        ]);
    }

    /**
     * Store a newly created bug.
     */
    public function store(StoreBugRequest $request, Project $project)
    {
        $this->authorize('create', Bug::class);

        $bug = $project->bugs()->create([
            ...$request->validated(),
            'reporter_id' => auth()->id(),
            'status_id'   => Status::where('name', 'Open')->first()->id,
        ]);

        return redirect()
            ->route('projects.bugs.show', [$project, $bug])
            ->with('success', 'Bug reported successfully.');
    }

    /**
     * Display the specified bug.
     */
    public function show(Project $project, Bug $bug): Response
    {
        $this->authorize('view', $bug);

        $bug->load(['status', 'assignee', 'reporter', 'comments.user', 'project']);

        return Inertia::render('Bugs/Show', [
            'bug'     => $bug,
            'project' => $project,
        ]);
    }

    /**
     * Show the form for editing a bug.
     */
    public function edit(Project $project, Bug $bug): Response
    {
        $this->authorize('update', $bug);

        return Inertia::render('Bugs/Edit', [
            'bug'      => $bug->load('status'),
            'project'  => $project,
            'statuses' => Status::all(),
            'users'    => User::select('id', 'name', 'email')->get(),
            'priorities' => Bug::getPriorities(),
        ]);
    }

    /**
     * Update the specified bug.
     */
    public function update(UpdateBugRequest $request, Project $project, Bug $bug)
    {
        $this->authorize('update', $bug);

        $bug->update($request->validated());

        return redirect()
            ->route('projects.bugs.show', [$project, $bug])
            ->with('success', 'Bug updated successfully.');
    }

    /**
     * Remove the specified bug.
     */
    public function destroy(Project $project, Bug $bug)
    {
        $this->authorize('delete', $bug);

        $bug->delete();

        return redirect()
            ->route('projects.bugs.index', $project)
            ->with('success', 'Bug deleted successfully.');
    }
}