<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Team;
use App\Models\User;
use App\Models\TeamUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EmployeeAssignController extends Controller
{
    /**
     * Assign employee(s) to a team
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
            'user_ids' => 'required|array',
            'user_ids.*' => 'exists:users,id',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        try {
            $teamId = $request->team_id;
            $userIds = $request->user_ids;

            foreach ($userIds as $userId) {
                // Avoid duplicate assignment
                TeamUser::updateOrCreate(
                    ['team_id' => $teamId, 'user_id' => $userId],
                    [] // no extra fields to update
                );
            }

            return response()->json([
                'status' => true,
                'message' => 'Employee(s) assigned to team successfully.',
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function edit($teamId)
    {
        try {
            // Check if team exists
            $team = Team::find($teamId);
            if (!$team) {
                return response()->json([
                    'status' => false,
                    'message' => 'Team not found'
                ], 404);
            }

            // All employees
            $allUsers = User::where('role', 'employee')
                ->get(['id', 'name', 'unique_id']);

            // Users already assigned to this team
            $assignedUsers = TeamUser::where('team_id', $teamId)
                ->with('user')
                ->get()
                ->pluck('user');

            return response()->json([
                'status' => true,
                'all_users' => $allUsers,
                'assigned_users' => $assignedUsers
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage()
            ], 500);
        }
    }
}
