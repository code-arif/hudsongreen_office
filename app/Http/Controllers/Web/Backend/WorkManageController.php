<?php

namespace App\Http\Controllers\Web\Backend;

use Exception;
use App\Models\Work;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\RescheduleRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleCalendarService;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class WorkManageController extends Controller
{
    protected $googleCalendar;

    // serivce injection
    public function __construct(GoogleCalendarService $googleCalendar)
    {
        $this->googleCalendar = $googleCalendar;
    }

    // List of all work
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Work::with('category', 'team')
                ->withCount(['rescheduleRequests' => function ($q) {
                    $q->where('status', 1);
                }])
                ->latest('id');

            // Apply filters if present
            if ($request->has('is_completed') && $request->is_completed !== null && $request->is_completed !== '') {
                $query->where('is_completed', $request->is_completed);
            }

            if ($request->has('is_rescheduled') && $request->is_rescheduled !== null && $request->is_rescheduled !== '') {
                $query->where('is_rescheduled', $request->is_rescheduled);
            }

            // Filter for reschedule requests
            if ($request->filled('has_reschedule_request')) {
                if ($request->has_reschedule_request == 1) {
                    $query->has('rescheduleRequests');
                } elseif ($request->has_reschedule_request == 0) {
                    $query->doesntHave('rescheduleRequests');
                }
            }

            $works = $query->get();

            return DataTables::of($works)
                ->addIndexColumn()

                // Title
                ->addColumn('title', function ($item) {
                    return strlen($item->title) > 15 ? substr($item->title, 0, 15) . '...' : $item->title;
                })

                // Category
                ->addColumn('category', function ($item) {
                    if ($item->category) {
                        $categoryName = $item->category->name;
                        if (strlen($categoryName) > 15) {
                            $categoryName = substr($categoryName, 0, 15) . '...';
                        }
                        $badgeClass = 'bg-info';
                    } else {
                        $categoryName = 'No Category';
                        $badgeClass = 'bg-warning';
                    }

                    return '<span class="badge ' . $badgeClass . '">' . e($categoryName) . '</span>';
                })

                // Team
                ->addColumn('team', function ($item) {
                    if ($item->team) {
                        $teamName = $item->team->name;
                        if (strlen($teamName) > 15) {
                            $teamName = substr($teamName, 0, 15) . '...';
                        }
                        $badgeClass = 'bg-info';
                    } else {
                        $teamName = 'No Team';
                        $badgeClass = 'bg-warning';
                    }

                    return '<span class="badge ' . $badgeClass . '">' . e($teamName) . '</span>';
                })

                // Location
                // ->addColumn('location', function ($item) {
                //     return strlen($item->location) > 20 ? substr($item->location, 0, 20) . '...' : $item->location;
                // })

                // Start Time (12-hour format)
                ->addColumn('start_time', function ($item) {
                    if ($item->is_all_day) {
                        return '<span class="badge bg-primary">All Day</span>';
                    }
                    return $item->start_datetime ? date('h:i A', strtotime($item->start_datetime)) : '---';
                })

                // End Time (12-hour format)
                ->addColumn('end_time', function ($item) {
                    if ($item->is_all_day) {
                        return '<span class="badge bg-primary">All Day</span>';
                    }
                    return $item->end_datetime ? date('h:i A', strtotime($item->end_datetime)) : '---';
                })

                // Work Date
                ->addColumn('work_date', function ($item) {
                    return $item->start_datetime ? date('d M Y', strtotime($item->start_datetime)) : '---';
                })

                // Is Completed
                ->addColumn('is_completed', function ($item) {
                    $isCompleted = $item->is_completed ? true : false;
                    $yesActive = $isCompleted ? 'active' : '';
                    $noActive = !$isCompleted ? 'active' : '';

                    return '
                    <div class="completion-toggle" data-id="' . $item->id . '">
                        <span onclick="showCompletionChangeAlert(' . $item->id . ', 0)" class="toggle-option ' . $noActive . ' left">No</span>
                        <span onclick="showCompletionChangeAlert(' . $item->id . ', 1)" class="toggle-option ' . $yesActive . ' right">Yes</span>
                    </div>
                ';
                })

                // Is Rescheduled
                ->addColumn('is_rescheduled', fn($item) => $item->is_rescheduled ? '<span class="badge bg-info">Yes</span>' : '<span class="badge bg-secondary">No</span>')

                // Actions
                ->addColumn('action', function ($item) {
                    $buttons = '<div class="d-flex justify-content-start align-items-center gap-1">
                <button type="button" class="btn btn-primary btn-sm editwork" data-id="' . $item->id . '">
                    <i class="fa fa-pen-to-square"></i> Edit
                </button>
                <button type="button" class="btn btn-sm btn-danger deleteBtn" onclick="showDeleteConfirm(' . $item->id . ')">
                    <i class="fa fa-trash"></i> Delete
                </button>';

                    if ($item->reschedule_requests_count > 0) {
                        $buttons .= '<button type="button" class="btn btn-warning btn-sm WorkRescheduleBtn"
                         data-id="' . $item->id . '">
                         <i class="fa fa-clock-rotate-left"></i> Reschedule
                     </button>';
                    }

                    $buttons .= '</div>';
                    return $buttons;
                })

                ->rawColumns(['title', 'location', 'start_time', 'end_time', 'is_completed', 'is_rescheduled', 'action', 'category', 'team'])
                ->make(true);
        }

        // work reschedule request
        $scheduleRequest = RescheduleRequest::where('status', true)->count();

        return view("backend.layouts.works.index", compact('scheduleRequest'));
    }

    // Store work
    public function store(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {
            // Validation
            $validator = Validator::make($request->all(), [
                'title'         => 'required|string|max:255',
                'description'   => 'nullable|string',
                'location'      => 'nullable|string',
                'latitude'      => 'nullable|numeric|between:-90,90',
                'longitude'     => 'nullable|numeric|between:-180,180',
                'start_time'    => 'required_if:is_all_day,false|date_format:h:i A',
                'end_time'      => 'required_if:is_all_day,false|date_format:h:i A',
                'work_date'     => 'required|date',
                'is_all_day'    => 'nullable|boolean',
                'team_id'       => 'nullable|exists:teams,id',
                'category_id'   => 'nullable|exists:categories,id',
                'category_name' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Handle Category
            $categoryId = $request->category_id;
            if (!$categoryId && $request->category_name) {
                $category = Category::create([
                    'name' => $request->category_name,
                ]);
                $categoryId = $category->id;
            }

            // Prepare DateTime fields
            $isAllDay = $request->is_all_day ?? false;

            if ($isAllDay) {
                // All day event
                $startDatetime = Carbon::parse($request->work_date)->startOfDay();
                $endDatetime = Carbon::parse($request->work_date)->endOfDay();
            } else {
                // Specific time event - Convert 12-hour to datetime
                $startDatetime = Carbon::parse($request->work_date . ' ' . $request->start_time);
                $endDatetime = Carbon::parse($request->work_date . ' ' . $request->end_time);
            }

            // Save Work
            $work = Work::create([
                'title'           => $request->title,
                'description'     => $request->description,
                'location'        => $request->location,
                'latitude'        => $request->latitude,
                'longitude'       => $request->longitude,
                'start_datetime'  => $startDatetime,
                'end_datetime'    => $endDatetime,
                'is_all_day'      => $isAllDay,
                'team_id'         => $request->team_id,
                'category_id'     => $categoryId,
            ]);

            // Google Calendar Sync (if user has connected Google)
            $user = auth()->user();
            if ($user && $user->google_access_token) {
                try {
                    $googleService = new GoogleCalendarService();

                    // Set access token
                    $token = [
                        'access_token' => $user->google_access_token,
                        'refresh_token' => $user->google_refresh_token,
                        'expires_in' => Carbon::parse($user->google_token_expires_at)->diffInSeconds(now()),
                    ];

                    $newToken = $googleService->setAccessToken($token);

                    // If token was refreshed, update user
                    if ($newToken) {
                        $user->update([
                            'google_access_token' => $newToken['access_token'],
                            'google_token_expires_at' => now()->addSeconds($newToken['expires_in']),
                        ]);
                    }

                    // Create event in Google Calendar
                    $googleEventId = $googleService->createEvent($work);

                    // Update work with Google event ID
                    $work->update([
                        'google_event_id' => $googleEventId,
                        'google_synced_at' => now(),
                    ]);

                    Log::info('Work synced to Google Calendar', [
                        'work_id' => $work->id,
                        'google_event_id' => $googleEventId
                    ]);
                } catch (Exception $e) {
                    // Don't fail the whole operation if Google sync fails
                    Log::error('Google Calendar sync failed during work creation', [
                        'work_id' => $work->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Work created successfully!',
                'data'    => $work,
            ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Edit work
    public function edit($id)
    {
        try {
            $work = Work::with(['team'])->find($id);

            if (!$work) {
                return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $work]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch work. ' . $e->getMessage()]);
        }
    }

    // Update work
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            $work = Work::find($id);
            if (!$work) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Work not found!',
                ], 404);
            }

            // Validation
            $validator = Validator::make($request->all(), [
                'title'         => 'required|string|max:255',
                'description'   => 'nullable|string',
                'location'      => 'nullable|string',
                'latitude'      => 'nullable|numeric|between:-90,90',
                'longitude'     => 'nullable|numeric|between:-180,180',
                'start_time'    => 'required_if:is_all_day,false|date_format:h:i A',
                'end_time'      => 'required_if:is_all_day,false|date_format:h:i A',
                'work_date'     => 'required|date',
                'is_all_day'    => 'nullable|boolean',
                'team_id'       => 'nullable|exists:teams,id',
                'category_id'   => 'nullable|exists:categories,id',
                'category_name' => 'nullable|string|max:255',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Handle Category
            $categoryId = $request->category_id;
            if (!$categoryId && $request->category_name) {
                $category = Category::firstOrCreate(['name' => $request->category_name]);
                $categoryId = $category->id;
            }

            // Prepare DateTime fields
            $isAllDay = $request->is_all_day ?? false;

            if ($isAllDay) {
                // All day event
                $startDatetime = Carbon::parse($request->work_date)->startOfDay();
                $endDatetime = Carbon::parse($request->work_date)->endOfDay();
            } else {
                // Specific time event - Convert 12-hour to datetime
                $startDatetime = Carbon::parse($request->work_date . ' ' . $request->start_time);
                $endDatetime = Carbon::parse($request->work_date . ' ' . $request->end_time);
            }

            // Update Work
            $work->update([
                'title'          => $request->title,
                'description'    => $request->description,
                'location'       => $request->location,
                'latitude'       => $request->latitude,
                'longitude'      => $request->longitude,
                'start_datetime' => $startDatetime,
                'end_datetime'   => $endDatetime,
                'is_all_day'     => $isAllDay,
                'team_id'        => $request->team_id,
                'category_id'    => $categoryId,
            ]);

            // Google Calendar Sync (if work is already synced)
            $user = auth()->user();
            if ($user && $user->google_access_token && $work->google_event_id) {
                try {
                    $googleService = new GoogleCalendarService();

                    // Set access token
                    $token = [
                        'access_token' => $user->google_access_token,
                        'refresh_token' => $user->google_refresh_token,
                        'expires_in' => Carbon::parse($user->google_token_expires_at)->diffInSeconds(now()),
                    ];

                    $newToken = $googleService->setAccessToken($token);

                    // If token was refreshed, update user
                    if ($newToken) {
                        $user->update([
                            'google_access_token' => $newToken['access_token'],
                            'google_token_expires_at' => now()->addSeconds($newToken['expires_in']),
                        ]);
                    }

                    // Update event in Google Calendar
                    $googleEventId = $googleService->updateEvent($work);

                    // Update sync timestamp
                    $work->update([
                        'google_synced_at' => now(),
                    ]);

                    Log::info('Work synced to Google Calendar (update)', [
                        'work_id' => $work->id,
                        'google_event_id' => $googleEventId
                    ]);
                } catch (Exception $e) {
                    // Don't fail the whole operation if Google sync fails
                    Log::error('Google Calendar sync failed during work update', [
                        'work_id' => $work->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Work updated successfully!',
                'data'    => $work,
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }

    // Delete work
    public function destroy(Work $work)
    {
        try {
            // Delete from Google Calendar first
            if (Auth::user()->google_access_token && $work->google_event_id) {
                try {
                    $token = json_decode(Auth::user()->google_access_token, true);

                    // Set access token and handle token refresh
                    $newToken = $this->googleCalendar->setAccessToken($token);

                    // If token was refreshed, update user's token
                    if ($newToken) {
                        Auth::user()->update([
                            'google_access_token' => json_encode($newToken)
                        ]);
                    }

                    // Now delete the event
                    $this->googleCalendar->deleteEvent($work->google_event_id);

                    Log::info('Successfully deleted from Google Calendar', [
                        'work_id' => $work->id,
                        'google_event_id' => $work->google_event_id
                    ]);
                } catch (Exception $e) {
                    Log::warning('Failed to delete from Google Calendar', [
                        'work_id' => $work->id,
                        'google_event_id' => $work->google_event_id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                }
            }

            // Delete from local database
            $work->delete();

            return response()->json([
                'success' => true,
                'message' => 'Work schedule deleted successfully!'
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting work', [
                'work_id' => $work->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete work: ' . $e->getMessage()
            ], 500);
        }
    }

    // Change wodrk complation status
    public function complation($id)
    {
        $work = Work::with(['team'])->find($id);

        if (!$work) {
            return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
        }

        // Toggle status
        $work->is_completed = $work->is_completed == true ? false : true;
        $work->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status Changed successfully!',
        ]);
    }

    // List of all category
    public function getCategory()
    {
        $categories = Category::select('id', 'name')->get();

        return response()->json([
            'status' => true,
            'data'   => $categories
        ]);
    }

    // edit reschedule work list
    public function reschedultEdit($id)
    {
        try {
            $reschedule = Work::with('request')->find($id);
            if (!$reschedule) {
                return response()->json(['success' => false, 'message' => 'Work not found.'], 404);
            }

            return response()->json(['success' => true, 'data' => $reschedule]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => 'Failed to fetch work. ' . $e->getMessage()]);
        }
    }

    // Update reschedule work
    public function rescheduleUpdate(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            $work = Work::find($id);
            if (!$work) {
                return response()->json([
                    'status' => false,
                    'message' => 'Work not found!'
                ], 404);
            }

            // Validation (match frontend fields!)
            $validator = Validator::make($request->all(), [
                'time' => 'nullable|date_format:H:i',
                'suggested_date'  => 'nullable|date',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validator->errors(),
                ], 422);
            }

            // Update Work
            $work->update([
                'time'     => $request->time,
                'work_date'      => $request->suggested_date,
                'is_rescheduled' => true,
                'is_completed' => false,
            ]);

            // Update Reschedule request
            $reschedule = RescheduleRequest::where('work_id', $work->id)->first();
            if ($reschedule) {
                $reschedule->update([
                    'status' => false,
                ]);
            }

            DB::commit();

            return response()->json([
                'status'  => true,
                'message' => 'Work rescheduled!',
                'data'    => $work,
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json([
                'status'  => false,
                'message' => 'Something went wrong: ' . $e->getMessage(),
            ], 500);
        }
    }
}
