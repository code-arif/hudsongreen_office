<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\User;
use App\Models\Work;
use App\Helper\Helper;
use App\Models\TeamUser;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class EmployeeManageController extends Controller
{
    // list all employee
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = User::with('team')->where('role', '!=', 'admin')->latest('id');
            $users = $query->get();

            return DataTables::of($users)
                ->addIndexColumn()

                // Name
                ->addColumn('name', function ($item) {
                    return strlen($item->name) > 20 ? substr($item->name, 0, 20) . '...' : $item->name;
                })

                // Email
                ->addColumn('email', fn($item) => $item->email ?? '---')

                // Phone
                ->addColumn('phone', fn($item) => $item->phone ?? '---')

                // Password
                ->addColumn('password', fn($item) => $item->password ?? '---')

                // Address
                ->addColumn('address', function ($item) {
                    return $item->address
                        ? (strlen($item->address) > 25 ? substr($item->address, 0, 25) . '...' : $item->address)
                        : '---';
                })

                // Teams
                ->addColumn('team', function ($item) {
                    if (!$item->team || !$item->team->team) {
                        return '<span class="badge bg-secondary">No Team</span>';
                    }
                    return '<span class="badge bg-primary">'
                        . $item->team->team->name
                        . ' (' . $item->team->team->unique_id . ')</span>';
                })

                // Avatar
                ->addColumn('avatar', function ($item) {
                    if ($item->avatar) {
                        return '<img src="' . asset('/' . $item->avatar) . '" alt="avatar" width="60" height="40">';
                    }
                    return '<span class="badge bg-secondary">No Avatar</span>';
                })

                // Unique ID
                ->addColumn('unique_id', fn($item) => $item->unique_id)

                // Action buttons
                ->addColumn('action', function ($item) {
                    $calendarUrl = route('employee.user.work.list', ['id' => $item->id]);
                    $mapUrl = route('employee.user.map.list', ['id' => $item->id]);
                    $actionButtons = '<div class="d-flex justify-content-start align-items-center gap-1">';

                    // Edit button
                    $actionButtons .= '<button type="button"
                                   class="btn btn-primary btn-sm editUser"
                                   data-id="' . $item->id . '">
                                   <i class="fa fa-pen-to-square"></i> Edit
                               </button>';

                    // Calendar button
                    $actionButtons .= '<a href="' . $calendarUrl . '" class="btn btn-info btn-sm">
                                   <i class="fa fa-calendar"></i> Calendar
                               </a>';

                   // Map View button (show only if user has a team)
                if ($item->team && $item->team->team) {
                    $actionButtons .= '<a href="' . $mapUrl . '" class="btn btn-success btn-sm">
                                       <i class="fa fa-map"></i> Map View
                                   </a>';
                }

                    // Delete button
                    $actionButtons .= '<button type="button" class="btn btn-sm btn-danger deleteBtn"
                                   onclick="showDeleteConfirm(' . $item->id . ')">
                                   <i class="fa fa-trash"></i> Delete
                               </button>';

                    $actionButtons .= '</div>';

                    return $actionButtons;
                })

                ->rawColumns(['avatar', 'action', 'team'])
                ->make();
        }

        return view("backend.layouts.users.index");
    }

    // store employee
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:users,email',
                'phone' => 'nullable|string|max:20|unique:users,phone',
                'password' => 'required|min:6',
                'address' => 'nullable|string|max:255',
                'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:5120',
            ]);


            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Handle avatar upload
            $avatarPath = null;
            if ($request->hasFile('avatar')) {
                $avatarPath = Helper::uploadImage($request->file('avatar'), 'avatars');
            }

            // Find last created user with numeric unique_id
            $lastUser = User::where('unique_id', 'like', 'USR_%')
                ->orderBy('id', 'desc')
                ->first();

            if ($lastUser) {
                // Get numeric part and increment
                $lastNumber = (int)substr($lastUser->unique_id, 4); // remove 'USR_'
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1; // first user
            }

            // Format with leading zeros
            $uniqueId = 'USR_' . str_pad($newNumber, 6, '0', STR_PAD_LEFT);

            // Create user
            $user = User::create([
                'name'          => $request->name,
                'email'         => $request->email,
                'phone'         => $request->phone,
                'password'      => $request->password,
                'role'          => 'employee',
                'address'       => $request->address,
                'avatar'        => $avatarPath,
                'unique_id'     => $uniqueId,
                'is_google_signin' => false,
                'is_apple_signin'  => false,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'User created successfully.',
                'data'    => $user,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // edit employee
    public function edit($id)
    {
        try {
            $user = User::find($id);

            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $user]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'User to fetch test. ' . $e->getMessage()]);
        }
    }

    // Update employee
    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            if (!$user) {
                return response()->json([
                    'status' => false,
                    'message' => 'User not found.',
                ], 404);
            }

            $validator = Validator::make($request->all(), [
                'name'      => 'required|string|max:255',
                'email'     => 'nullable|email|unique:users,email,' . $user->id,
                'phone'     => 'nullable|string|max:20|unique:users,phone,' . $user->id,
                'password'  => 'nullable|string|min:6',
                'address'   => 'nullable|string|max:255',
                'avatar'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Handle avatar upload
            $avatarPath = $user->avatar;
            if ($request->hasFile('avatar')) {
                if ($user->avatar) {
                    Helper::deleteImage($user->avatar);
                }

                $avatarPath = Helper::uploadImage($request->file('avatar'), 'avatars');
            }

            // Update user
            $user->update([
                'name'      => $request->name,
                'email'     => $request->email,
                'phone'     => $request->phone,
                'password'  => $request->filled('password') ? $request->password : $user->password,
                'address'   => $request->address,
                'avatar'    => $avatarPath,
            ]);

            return response()->json([
                'status'  => true,
                'message' => 'User updated successfully.',
                'data'    => $user,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete employee
    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Employee not found.'
            ], 404);
        }

        try {
            // Delete image if exists
            if ($user->avatar) {
                Helper::deleteImage($user->image_path);
            }

            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'Employee deleted successfully.'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete Employee.',
                'error'   => $e->getMessage()
            ], 500);
        }
    }

    // Employee work list
    public function workList($id)
    {
        // Fetch the user with their teams
        $user = User::with('teams')->findOrFail($id);

        // Check if the user is an employee
        if ($user->role !== 'employee') {
            abort(404, 'Employee not found');
        }

        // Get all team IDs the user belongs to
        $teamIds = $user->teams->pluck('id');

        // Fetch works assigned to the user's teams
        $works = $teamIds->isEmpty()
            ? collect()
            : Work::whereIn('team_id', $teamIds)
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

        return view('backend.layouts.users.calendar', compact('events', 'user'));
    }

    // Employee work list in map with polyline
    public function mapWorkList($id)
    {
        // Fetch teams for the given user_id
        $teamIds = TeamUser::where('user_id', $id)->pluck('team_id');

        if ($teamIds->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'User is not assigned to any team',
            ], 404);
        }

        // Fetch works for these teams
        $works = Work::whereIn('team_id', $teamIds)
            ->select(
                'id',
                'title',
                'description',
                'location',
                'latitude',
                'longitude',
                'work_date',
                'start_time',
                'end_time',
                'is_completed',
                'is_rescheduled',
                'unique_id'
            )
            ->get();

        // Return the view with works data
        return view('backend.layouts.users.map', compact('works'));
    }
}
