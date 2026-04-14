<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bug;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BugApiController extends Controller
{
    /**
     * Public stats endpoint — consumed via Axios in api.js
     */
    public function stats(): JsonResponse
    {
        return response()->json([
            'total_bugs'       => Bug::count(),
            'open_bugs'        => Bug::whereHas('status', fn($q) => $q->where('name', 'Open'))->count(),
            'in_progress'      => Bug::whereHas('status', fn($q) => $q->where('name', 'In Progress'))->count(),
            'resolved_today'   => Bug::whereHas('status', fn($q) => $q->where('name', 'Resolved'))
                                     ->whereDate('updated_at', today())->count(),
            'critical_bugs'    => Bug::where('priority', 'critical')->count(),
            'total_projects'   => Project::count(),
        ]);
    }

    /**
     * Public project listing
     */
    public function projects(): JsonResponse
    {
        $projects = Project::withCount('bugs')->get(['id', 'name', 'description']);

        return response()->json(['data' => $projects]);
    }

    /**
     * List all bugs — authenticated
     */
    public function index(Request $request): JsonResponse
    {
        $bugs = Bug::with(['status', 'assignee', 'project'])
            ->when($request->status, fn($q) => $q->whereHas('status', fn($s) => $s->where('name', $request->status)))
            ->when($request->priority, fn($q) => $q->where('priority', $request->priority))
            ->when($request->search, fn($q) => $q->where('title', 'like', "%{$request->search}%"))
            ->paginate(20);

        return response()->json($bugs);
    }

    public function show(Bug $bug): JsonResponse
    {
        return response()->json($bug->load(['status', 'assignee', 'reporter', 'comments.user']));
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'priority'    => 'required|in:low,medium,high,critical',
            'project_id'  => 'required|exists:projects,id',
            'assignee_id' => 'nullable|exists:users,id',
        ]);

        $bug = Bug::create([
            ...$validated,
            'reporter_id' => auth()->id(),
            'status_id'   => Status::where('name', 'Open')->first()->id,
        ]);

        return response()->json($bug->load('status'), 201);
    }

    public function update(Request $request, Bug $bug): JsonResponse
    {
        $this->authorize('update', $bug);

        $bug->update($request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'priority'    => 'sometimes|in:low,medium,high,critical',
            'assignee_id' => 'nullable|exists:users,id',
        ]));

        return response()->json($bug->fresh(['status', 'assignee']));
    }

    public function destroy(Bug $bug): JsonResponse
    {
        $this->authorize('delete', $bug);
        $bug->delete();

        return response()->json(['message' => 'Bug deleted successfully.']);
    }

    public function updateStatus(Request $request, Bug $bug): JsonResponse
    {
        $this->authorize('update', $bug);

        $status = Status::where('name', $request->validate([
            'status' => 'required|exists:statuses,name',
        ])['status'])->first();

        $bug->update(['status_id' => $status->id]);

        return response()->json($bug->fresh('status'));
    }

    public function assign(Request $request, Bug $bug): JsonResponse
    {
        $this->authorize('update', $bug);

        $bug->update($request->validate([
            'assignee_id' => 'required|exists:users,id',
        ]));

        return response()->json($bug->fresh('assignee'));
    }

    public function byPriority(): JsonResponse
    {
        $data = Bug::selectRaw('priority, count(*) as count')
            ->groupBy('priority')
            ->get();

        return response()->json($data);
    }

    public function byStatus(): JsonResponse
    {
        $data = Bug::with('status')
            ->selectRaw('status_id, count(*) as count')
            ->groupBy('status_id')
            ->get()
            ->map(fn($row) => ['status' => $row->status->name, 'count' => $row->count]);

        return response()->json($data);
    }
}