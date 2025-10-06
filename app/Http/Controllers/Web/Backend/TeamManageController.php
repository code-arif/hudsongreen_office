<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Team;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TeamManageController extends Controller
{

    /**
     * List of all team
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $query = Team::latest('id');
            $query = Team::with('users')->latest('id');
            $teams = $query->get();

            return DataTables::of($teams)
                ->addIndexColumn()

                // Name
                ->addColumn('name', function ($item) {
                    return strlen($item->name) > 20 ? substr($item->name, 0, 20) . '...' : $item->name;
                })

                // Description
                ->addColumn('description', function ($item) {
                    return $item->description
                        ? (strlen($item->description) > 50 ? substr($item->description, 0, 50) . '...' : $item->description)
                        : '---';
                })

                // Unique ID
                ->addColumn('unique_id', fn($item) => $item->unique_id)

                // Users list (name + unique_id)
                ->addColumn('users', function ($item) {
                    if ($item->users->isEmpty()) {
                        return '<span class="badge bg-secondary">No Empoyee</span>';
                    }

                    // Wrap badges in a div with flex-wrap
                    $badges = $item->users->map(function ($user) {
                        return '<span class="badge bg-primary me-1 mb-1">' . $user->name . ' (' . $user->unique_id . ')</span>';
                    })->implode(' ');

                    return '<div style="display: flex; flex-wrap: wrap;">' . $badges . '</div>';
                })



                // Action buttons
                ->addColumn('action', function ($item) {

                    $calendarUrl = route('team.work.list', ['id' => $item->id]);

                    return '<div class="d-flex justify-content-start align-items-center gap-1">
                           <button type="button"
                                   class="btn btn-primary btn-sm editTeam"
                                   data-id="' . $item->id . '">
                            <i class="fa fa-pen-to-square"></i> Edit
                            </button>

                            <button type="button" class="btn btn-sm btn-success assignBtn"
                                data-id="' . $item->id . '">
                                <i class="fas fa-syringe"></i> Assign Employee
                            </button>

                            <a href="' . $calendarUrl . '" class="btn btn-info btn-sm">
                                <i class="fa fa-calendar"></i> Calendar
                            </a>

                             <button type="button" class="btn btn-sm btn-danger deleteBtn"
                                onclick="showDeleteConfirm(' . $item->id . ')">
                                <i class="fa fa-trash"></i> Delete
                            </button>
                        </div>';
                })

                ->rawColumns(['action', 'users'])
                ->make();
        }

        return view("backend.layouts.teams.index");
    }

    /**
     * Store new team
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:teams,name',
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $team = Team::create([
                'name' => $request->name,
                'description' => $request->description,
                'unique_id' => 'TEAM_' . date('ymd') . mt_rand(100, 999),

            ]);

            return response()->json([
                'status' => true,
                'message' => 'Team created successfully.',
                'data' => $team,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Summary of edit
     */
    public function edit($id)
    {
        try {
            $team = Team::find($id);

            if (!$team) {
                return response()->json(['success' => false, 'message' => 'Team not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $team]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Team to fetch test. ' . $e->getMessage()]);
        }
    }

    /**
     * Update existing team
     */
    public function update(Request $request, $id)
    {
        try {
            $team = Team::find($id);
            if (!$team) {
                return response()->json([
                    'status' => false,
                    'message' => 'Team not found.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255|unique:teams,name,' . $team->id,
                'description' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            $team->update([
                'name' => $request->name,
                'description' => $request->description,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Team updated successfully.',
                'data' => $team,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Summary of delete
     */
    public function delete($id)
    {
        $team = Team::find($id);
        if (!$team) {
            return response()->json([
                'success' => false,
                'message' => 'Team not found.'
            ], 404);
        }

        try {
            $team->delete();

            return response()->json([
                'success' => true,
                'message' => 'Team deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Team.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Team list for work assigning
     */
    public function teamList()
    {
        $teams = Team::select('id', 'name', 'unique_id')->get();

        return response()->json([
            'status' => true,
            'data'   => $teams
        ]);
    }

    /**
     * Team work list in calendar view
     */
    public function workList($id)
    {
        // Fetch the specific team
        $team = Team::findOrFail($id);

        // Fetch all works assigned to the specified team
        $works = Work::where('team_id', $id)
            ->whereNotNull('work_date')
            ->get();

        $events = $works->map(function ($work) {
            // Ensure work_date is valid
            if (!$work->work_date) {
                return null; // Skip invalid
            }

            // Clean time values: only allow HH:MM:SS format
            $cleanStartTime = null;
            $cleanEndTime = null;

            if ($work->start_time && preg_match('/^\d{2}:\d{2}:\d{2}$/', $work->start_time)) {
                $cleanStartTime = $work->start_time;
            }

            if ($work->end_time && preg_match('/^\d{2}:\d{2}:\d{2}$/', $work->end_time)) {
                $cleanEndTime = $work->end_time;
            }

            // If no valid times or incomplete times, treat as all-day
            if (!$cleanStartTime || !$cleanEndTime) {
                return [
                    'id' => $work->id,
                    'title' => $work->title,
                    'start' => $work->work_date,
                    'description' => $work->description ?? 'No description',
                    'allDay' => true,
                    'backgroundColor' => $work->is_completed ? '#34c38f' : '#60a5fa', // Green for completed, blue for pending
                    'borderColor' => $work->is_completed ? '#2a926f' : '#1e88e5',
                    'extendedProps' => [
                        'location' => $work->location ?? 'Not specified',
                        'status' => $work->status,
                        'is_rescheduled' => $work->is_rescheduled,
                        'note' => $work->note ?? 'No notes',
                    ],
                ];
            }

            // Build full datetime strings
            $startStr = $work->work_date . ' ' . $cleanStartTime;
            $endStr = $work->work_date . ' ' . $cleanEndTime;

            try {
                return [
                    'id' => $work->id,
                    'title' => $work->title,
                    'start' => Carbon::parse($startStr)->toISOString(),
                    'end' => Carbon::parse($endStr)->toISOString(),
                    'description' => $work->description ?? 'No description',
                    'allDay' => false,
                    'backgroundColor' => $work->is_completed ? '#34c38f' : '#60a5fa',
                    'borderColor' => $work->is_completed ? '#2a926f' : '#1e88e5',
                    'extendedProps' => [
                        'location' => $work->location ?? 'Not specified',
                        'status' => $work->status,
                        'is_rescheduled' => $work->is_rescheduled,
                        'note' => $work->note ?? 'No notes',
                    ],
                ];
            } catch (Exception $e) {
                // Fallback to all-day if parsing fails
                return [
                    'id' => $work->id,
                    'title' => $work->title,
                    'start' => $work->work_date,
                    'description' => $work->description ?? 'No description',
                    'allDay' => true,
                    'backgroundColor' => $work->is_completed ? '#34c38f' : '#60a5fa',
                    'borderColor' => $work->is_completed ? '#2a926f' : '#1e88e5',
                    'extendedProps' => [
                        'location' => $work->location ?? 'Not specified',
                        'status' => $work->status,
                        'is_rescheduled' => $work->is_rescheduled,
                        'note' => $work->note ?? 'No notes',
                    ],
                ];
            }
        })->filter()->values(); // Remove nulls and reindex

        return view('backend.layouts.teams.calendar', compact('events', 'team'));
    }
}
