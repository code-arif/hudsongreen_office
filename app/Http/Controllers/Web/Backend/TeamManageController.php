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

                // Users list (name)
                ->addColumn('users', function ($item) {
                    if ($item->users->isEmpty()) {
                        return '<span class="badge bg-secondary">No Empoyee</span>';
                    }

                    // Wrap badges in a div with flex-wrap
                    $badges = $item->users->map(function ($user) {
                        return '<span class="badge bg-primary me-1 mb-1">' . $user->name . '</span>';
                    })->implode(' ');

                    return '<div style="display: flex; flex-wrap: wrap;">' . $badges . '</div>';
                })



                // Action buttons
                ->addColumn('action', function ($item) {
                    $mapUrl = route('team.work.map.list', ['id' => $item->id]);

                    return '<div class="d-flex justify-content-start align-items-center gap-1">
                           <button type="button"
                                   class="btn btn-warning btn-sm editTeam"
                                   data-id="' . $item->id . '">
                            <i class="fa fa-pen-to-square"></i> Edit
                            </button>

                            <button type="button" class="btn btn-sm btn-success assignBtn"
                                data-id="' . $item->id . '">
                                <i class="fas fa-syringe"></i> Assign Employee
                            </button>

                            <a href="' . $mapUrl . '" class="btn btn-secondary btn-sm">
                                <i class="fa fa-map"></i> Map View
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
        $teams = Team::select('id', 'name')->get();

        return response()->json([
            'status' => true,
            'data'   => $teams
        ]);
    }


    /**
     * Team work list in map view with polyline
     */
    public function mapWorkList($id)
    {
        // Fetch works assigned to this team
        $works = Work::where('team_id', $id)
            ->select(
                'id',
                'title',
                'description',
                'location',
                'latitude',
                'longitude',
                'start_datetime',
                'is_completed',
                'is_rescheduled'
            )
            ->get();

        if ($works->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'No works found for this team',
            ], 404);
        }

        // Return map view for team works
        return view('backend.layouts.teams.map', compact('works'));
    }
}
