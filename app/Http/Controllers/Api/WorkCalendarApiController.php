<?php

namespace App\Http\Controllers\Api;

use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;

class WorkCalendarApiController extends Controller
{
    /**
     * Get all works (for calendar)
     */
    public function index(Request $request)
    {
        $query = Work::with(['team', 'category']);

        // Filter by date range for calendar
        if ($request->has('start') && $request->has('end')) {
            $start = Carbon::parse($request->start)->startOfDay();
            $end = Carbon::parse($request->end)->endOfDay();
            $query->whereBetween('work_date', [$start, $end]);
        }

        // Filter by team
        if ($request->has('team_id')) {
            $query->where('team_id', $request->team_id);
        }

        // Filter by category
        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $works = $query->orderBy('work_date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'works' => $works
        ]);
    }

    /**
     * Store a new work
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'time' => 'required',
            'work_date' => 'required|date',
            'note' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1,2',
            'team_id' => 'nullable|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'is_completed' => 'nullable|boolean',
            'is_rescheduled' => 'nullable|boolean',
        ]);

        $work = Work::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Work created successfully',
            'work' => $work->load(['team', 'category'])
        ], 201);
    }

    /**
     * Get a single work
     */
    public function show($id)
    {
        $work = Work::with(['team', 'category'])->findOrFail($id);

        return response()->json([
            'success' => true,
            'work' => $work
        ]);
    }

    /**
     * Update a work
     */
    public function update(Request $request, $id)
    {
        $work = Work::findOrFail($id);

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'time' => 'sometimes|required',
            'work_date' => 'sometimes|required|date',
            'note' => 'nullable|string',
            'status' => 'nullable|integer|in:0,1,2',
            'team_id' => 'nullable|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'is_completed' => 'nullable|boolean',
            'is_rescheduled' => 'nullable|boolean',
        ]);

        $work->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Work updated successfully',
            'work' => $work->load(['team', 'category'])
        ]);
    }

    /**
     * Delete a work
     */
    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();

        return response()->json([
            'success' => true,
            'message' => 'Work deleted successfully'
        ]);
    }

    /**
     * Bulk update works
     */
    public function bulkUpdate(Request $request)
    {
        $validated = $request->validate([
            'work_ids' => 'required|array',
            'work_ids.*' => 'exists:works,id',
            'status' => 'nullable|integer|in:0,1,2',
            'team_id' => 'nullable|exists:teams,id',
            'is_completed' => 'nullable|boolean',
        ]);

        $updates = collect($validated)->except('work_ids')->filter()->toArray();

        Work::whereIn('id', $validated['work_ids'])->update($updates);

        return response()->json([
            'success' => true,
            'message' => 'Works updated successfully'
        ]);
    }

    /**
     * Get work statistics
     */
    public function statistics(Request $request)
    {
        $query = Work::query();

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('work_date', [$request->start_date, $request->end_date]);
        }

        $total = $query->count();
        $completed = (clone $query)->where('is_completed', true)->count();
        $pending = (clone $query)->where('status', 0)->count();
        $inProgress = (clone $query)->where('status', 1)->count();
        $rescheduled = (clone $query)->where('is_rescheduled', true)->count();

        // Works by team
        $byTeam = (clone $query)->with('team')
            ->get()
            ->groupBy('team_id')
            ->map(function ($works, $teamId) {
                return [
                    'team' => $works->first()->team ? $works->first()->team->name : 'No Team',
                    'count' => $works->count()
                ];
            })->values();

        // Works by category
        $byCategory = (clone $query)->with('category')
            ->get()
            ->groupBy('category_id')
            ->map(function ($works, $categoryId) {
                return [
                    'category' => $works->first()->category ? $works->first()->category->name : 'No Category',
                    'count' => $works->count()
                ];
            })->values();

        return response()->json([
            'success' => true,
            'statistics' => [
                'total' => $total,
                'completed' => $completed,
                'pending' => $pending,
                'in_progress' => $inProgress,
                'rescheduled' => $rescheduled,
                'completion_rate' => $total > 0 ? round(($completed / $total) * 100, 2) : 0,
                'by_team' => $byTeam,
                'by_category' => $byCategory,
            ]
        ]);
    }

    /**
     * Search works
     */
    public function search(Request $request)
    {
        $query = Work::with(['team', 'category']);

        if ($request->has('q')) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', "%{$searchTerm}%")
                    ->orWhere('description', 'like', "%{$searchTerm}%")
                    ->orWhere('location', 'like', "%{$searchTerm}%");
            });
        }

        $works = $query->orderBy('work_date', 'desc')
            ->orderBy('time', 'desc')
            ->paginate(20);

        return response()->json([
            'success' => true,
            'works' => $works
        ]);
    }

    /**
     * Get upcoming works
     */
    public function upcoming(Request $request)
    {
        $limit = $request->get('limit', 10);

        $works = Work::with(['team', 'category'])
            ->where('work_date', '>=', now()->toDateString())
            ->where('is_completed', false)
            ->orderBy('work_date', 'asc')
            ->orderBy('time', 'asc')
            ->limit($limit)
            ->get();

        return response()->json([
            'success' => true,
            'works' => $works
        ]);
    }

    /**
     * Get overdue works
     */
    public function overdue(Request $request)
    {
        $works = Work::with(['team', 'category'])
            ->where('work_date', '<', now()->toDateString())
            ->where('is_completed', false)
            ->orderBy('work_date', 'desc')
            ->orderBy('time', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'works' => $works
        ]);
    }
}
