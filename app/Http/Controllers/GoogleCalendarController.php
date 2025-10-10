<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Work;
use App\Models\Category;
use Illuminate\Http\Request;
use Laravel\Reverb\Loggers\Log;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleCalendarService;

class GoogleCalendarController extends Controller
{
    protected $googleCalendar;

    // service injection
    public function __construct(GoogleCalendarService $googleCalendar)
    {
        $this->googleCalendar = $googleCalendar;
    }

    // Display the calendar view
    public function index(Request $request)
    {
        $teams = Team::all();
        $categories = Category::all();
        $user = Auth::user();

        $isGoogleConnected = !empty($user->google_access_token);

        return view('backend.layouts.calendar.index', compact('teams', 'categories', 'isGoogleConnected'));
    }

    // Fetch events with filters
    public function getEvents(Request $request)
    {
        try {
            $start = $request->get('start');
            $end = $request->get('end');
            $teamId = $request->get('team_id');
            $status = $request->get('status');
            $categoryId = $request->get('category_id');

            $query = Work::with(['team', 'category']);

            // Date range filter
            if ($start && $end) {
                $query->where(function ($q) use ($start, $end) {
                    $q->whereBetween('work_date', [
                        Carbon::parse($start)->startOfDay(),
                        Carbon::parse($end)->endOfDay()
                    ]);
                });
            }

            // Team filter
            if ($teamId) {
                $query->where('team_id', $teamId);
            }

            // Status filter
            if ($status === 'completed') {
                $query->where('is_completed', true);
            } elseif ($status === 'pending') {
                $query->where('is_completed', false);
            } elseif ($status === 'rescheduled') {
                $query->where('is_rescheduled', true);
            }

            // Category filter
            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }

            $works = $query->get();

            $events = $works->map(function ($work) {
                try {
                    $workDate = Carbon::parse($work->work_date);
                    $timeStr = $work->time ?? '09:00:00';

                    $startDateTime = $work->start_datetime
                        ? Carbon::parse($work->start_datetime)
                        : Carbon::parse($workDate->format('Y-m-d') . ' ' . $timeStr);

                    $endDateTime = $work->end_datetime
                        ? Carbon::parse($work->end_datetime)
                        : $startDateTime->copy()->addHour();

                    return [
                        'id' => $work->id,
                        'title' => $work->title,
                        'start' => $startDateTime->toIso8601String(),
                        'end' => $endDateTime->toIso8601String(),
                        'description' => $work->description,
                        'location' => $work->location,
                        'backgroundColor' => $this->getEventColor($work),
                        'borderColor' => $this->getEventBorderColor($work),
                        'extendedProps' => [
                            'team' => $work->team ? $work->team->name : null,
                            'category' => $work->category ? $work->category->name : null,
                            'completed' => $work->is_completed,
                            'rescheduled' => $work->is_rescheduled,
                            'latitude' => $work->latitude,
                            'longitude' => $work->longitude,
                            'note' => $work->note,
                            'google_event_id' => $work->google_event_id,
                        ],
                    ];
                } catch (Exception $e) {
                    Log::error('Error processing work for calendar', [
                        'work_id' => $work->id,
                        'error' => $e->getMessage()
                    ]);
                    return null;
                }
            })->filter()->values();

            return response()->json($events);
        } catch (Exception $e) {
            Log::error('getEvents error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => 'Failed to load events',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // Store a new work schedule
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'time' => 'required',
                'work_date' => 'required|date',
                'end_time' => 'nullable',
                'team_id' => 'nullable|exists:teams,id',
                'category_id' => 'nullable|exists:categories,id',
                'is_completed' => 'boolean',
                'is_rescheduled' => 'boolean',
                'note' => 'nullable|string',
            ]);

            $startDateTime = Carbon::parse($validated['work_date'] . ' ' . $validated['time']);
            $endDateTime = isset($validated['end_time']) && $validated['end_time']
                ? Carbon::parse($validated['work_date'] . ' ' . $validated['end_time'])
                : $startDateTime->copy()->addHour();

            $validated['start_datetime'] = $startDateTime;
            $validated['end_datetime'] = $endDateTime;
            $validated['is_completed'] = $request->has('is_completed');
            $validated['is_rescheduled'] = $request->has('is_rescheduled');

            $work = Work::create($validated);
            dd($work);

            // Sync to Google Calendar
            if (Auth::user()->google_access_token) {
                try {
                    $this->syncWorkToGoogle($work);
                } catch (Exception $e) {
                    Log::warning('Failed to sync to Google Calendar', [
                        'work_id' => $work->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Work schedule created successfully!',
                'work' => $work->load(['team', 'category'])
            ]);
        } catch (Exception $e) {
            Log::error('Error creating work', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to create work: ' . $e->getMessage()
            ], 500);
        }
    }

    // Show details of a specific work schedule
    public function show(Work $work)
    {
        $work->load(['team', 'category']);
        return response()->json($work);
    }

    // Update an existing work schedule
    public function update(Request $request, Work $work)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'time' => 'required',
                'work_date' => 'required|date',
                'end_time' => 'nullable',
                'team_id' => 'nullable|exists:teams,id',
                'category_id' => 'nullable|exists:categories,id',
                'is_completed' => 'boolean',
                'is_rescheduled' => 'boolean',
                'note' => 'nullable|string',
            ]);

            $startDateTime = Carbon::parse($validated['work_date'] . ' ' . $validated['time']);
            $endDateTime = isset($validated['end_time']) && $validated['end_time']
                ? Carbon::parse($validated['work_date'] . ' ' . $validated['end_time'])
                : $startDateTime->copy()->addHour();

            $validated['start_datetime'] = $startDateTime;
            $validated['end_datetime'] = $endDateTime;
            $validated['is_completed'] = $request->has('is_completed');
            $validated['is_rescheduled'] = $request->has('is_rescheduled');

            $work->update($validated);

            // Update Google Calendar
            if (Auth::user()->google_access_token && $work->google_event_id) {
                try {
                    $this->syncWorkToGoogle($work, true);
                } catch (Exception $e) {
                    Log::warning('Failed to update Google Calendar', [
                        'work_id' => $work->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'message' => 'Work schedule updated successfully!',
                'work' => $work->load(['team', 'category'])
            ]);
        } catch (Exception $e) {
            Log::error('Error updating work', [
                'work_id' => $work->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update work: ' . $e->getMessage()
            ], 500);
        }
    }

    // Delete a work schedule
    public function destroy(Work $work)
    {
        try {
            // Delete from Google Calendar
            if (Auth::user()->google_access_token && $work->google_event_id) {
                try {
                    $token = json_decode(Auth::user()->google_access_token, true);
                    $this->googleCalendar->setAccessToken($token);
                    $this->googleCalendar->deleteEvent($work->google_event_id);
                } catch (Exception $e) {
                    Log::warning('Failed to delete from Google Calendar', [
                        'work_id' => $work->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            $work->delete();

            return response()->json([
                'success' => true,
                'message' => 'Work schedule deleted successfully!'
            ]);
        } catch (Exception $e) {
            Log::error('Error deleting work', [
                'work_id' => $work->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to delete work'
            ], 500);
        }
    }

    // Toggle completion status
    public function toggleStatus(Request $request, Work $work)
    {
        try {
            $work->update(['is_completed' => !$work->is_completed]);

            // Update Google Calendar
            if (Auth::user()->google_access_token && $work->google_event_id) {
                try {
                    $this->syncWorkToGoogle($work, true);
                } catch (Exception $e) {
                    Log::warning('Failed to update status in Google Calendar', [
                        'work_id' => $work->id,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'completed' => $work->is_completed,
                'message' => $work->is_completed ? 'Work marked as completed!' : 'Work marked as pending!'
            ]);
        } catch (Exception $e) {
            Log::error('Error toggling status', [
                'work_id' => $work->id,
                'error' => $e->getMessage()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle status'
            ], 500);
        }
    }

    // Redirect to Google for authentication
    public function redirectToGoogle()
    {
        try {
            $authUrl = $this->googleCalendar->getAuthUrl();
            return redirect()->away($authUrl);
        } catch (Exception $e) {
            Log::error('Google Redirect Error', [
                'error' => $e->getMessage()
            ]);

            return redirect()->route('calendar.index')
                ->with('error', 'Failed to connect to Google Calendar');
        }
    }

    // Handle Google OAuth callback
    public function handleGoogleCallback(Request $request)
    {
        try {
            if ($request->has('error')) {
                return redirect()->route('calendar.index')
                    ->with('error', 'Google authentication cancelled');
            }

            if (!$request->has('code')) {
                return redirect()->route('calendar.index')
                    ->with('error', 'No authorization code received');
            }

            $token = $this->googleCalendar->authenticate($request->get('code'));

            $user = Auth::user();
            $user->google_access_token = json_encode($token);

            if (isset($token['refresh_token'])) {
                $user->google_refresh_token = $token['refresh_token'];
            }

            if (isset($token['expires_in'])) {
                $user->google_token_expires_at = Carbon::now()->addSeconds($token['expires_in']);
            }

            $user->save();

            Log::info('Google Calendar connected', ['user_id' => $user->id]);

            return redirect()->route('calendar.index')
                ->with('success', 'Google Calendar connected successfully!');
        } catch (Exception $e) {
            Log::error('Google Callback Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('calendar.index')
                ->with('error', 'Failed to connect Google Calendar: ' . $e->getMessage());
        }
    }

    // Disconnect Google Calendar
    public function disconnect()
    {
        try {
            $user = Auth::user();
            $user->google_access_token = null;
            $user->google_refresh_token = null;
            $user->google_token_expires_at = null;
            $user->save();

            // Keep google_event_id for reference but clear sync
            Work::whereNotNull('google_event_id')->update(['google_event_id' => null]);

            return redirect()->route('calendar.index')
                ->with('success', 'Google Calendar disconnected successfully!');
        } catch (Exception $e) {
            Log::error('Google Disconnect Error', [
                'error' => $e->getMessage()
            ]);

            return redirect()->route('calendar.index')
                ->with('error', 'Failed to disconnect Google Calendar');
        }
    }

    // Sync events from Google Calendar
    public function syncFromGoogle(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user->google_access_token) {
                return response()->json([
                    'success' => false,
                    'message' => 'Google Calendar not connected'
                ], 400);
            }

            $token = json_decode($user->google_access_token, true);
            $newToken = $this->googleCalendar->setAccessToken($token);

            if ($newToken) {
                $user->google_access_token = json_encode($newToken);
                if (isset($newToken['refresh_token'])) {
                    $user->google_refresh_token = $newToken['refresh_token'];
                }
                if (isset($newToken['expires_in'])) {
                    $user->google_token_expires_at = Carbon::now()->addSeconds($newToken['expires_in']);
                }
                $user->save();
            }

            $startDate = $request->get('start', Carbon::now()->startOfMonth());
            $endDate = $request->get('end', Carbon::now()->endOfMonth());

            $events = $this->googleCalendar->listEvents($startDate, $endDate);

            $syncedCount = 0;
            $updatedCount = 0;

            foreach ($events as $event) {
                if (!$event->getStart()->getDateTime()) {
                    continue; // Skip all-day events
                }

                $googleEventId = $event->getId();
                $existingWork = Work::where('google_event_id', $googleEventId)->first();

                $startDateTime = Carbon::parse($event->getStart()->getDateTime());
                $endDateTime = $event->getEnd()->getDateTime()
                    ? Carbon::parse($event->getEnd()->getDateTime())
                    : $startDateTime->copy()->addHour();

                $workData = [
                    'title' => $event->getSummary() ?? 'Untitled Event',
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation(),
                    'work_date' => $startDateTime->toDateString(),
                    'time' => $startDateTime->toTimeString(),
                    'start_datetime' => $startDateTime,
                    'end_datetime' => $endDateTime,
                    'google_event_id' => $googleEventId,
                ];

                if ($existingWork) {
                    $existingWork->update($workData);
                    $updatedCount++;
                } else {
                    Work::create($workData);
                    $syncedCount++;
                }
            }

            $message = "Successfully synced from Google Calendar! ";
            $message .= "New: {$syncedCount}, Updated: {$updatedCount}";

            return response()->json([
                'success' => true,
                'message' => $message,
                'synced' => $syncedCount,
                'updated' => $updatedCount
            ]);
        } catch (Exception $e) {
            Log::error('Google Sync Error', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Sync a single work to Google Calendar
    private function syncWorkToGoogle(Work $work, $update = false)
    {
        try {
            $user = Auth::user();

            if (!$user->google_access_token) {
                return;
            }

            $token = json_decode($user->google_access_token, true);
            $newToken = $this->googleCalendar->setAccessToken($token);

            if ($newToken) {
                $user->google_access_token = json_encode($newToken);
                if (isset($newToken['refresh_token'])) {
                    $user->google_refresh_token = $newToken['refresh_token'];
                }
                if (isset($newToken['expires_in'])) {
                    $user->google_token_expires_at = Carbon::now()->addSeconds($newToken['expires_in']);
                }
                $user->save();
            }

            if ($update && $work->google_event_id) {
                $this->googleCalendar->updateEvent($work);
            } else {
                $eventId = $this->googleCalendar->createEvent($work);
                if ($eventId) {
                    $work->google_event_id = $eventId;
                    $work->save();
                }
            }
        } catch (Exception $e) {
            Log::error('Sync to Google Error', [
                'work_id' => $work->id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    // Determine event color based on status
    private function getEventColor($work)
    {
        if ($work->is_completed) {
            return '#10b981'; // Green
        } elseif ($work->is_rescheduled) {
            return '#f59e0b'; // Amber
        }
        return '#3b82f6'; // Blue
    }

    // Determine event border color based on status
    private function getEventBorderColor($work)
    {
        if ($work->is_completed) {
            return '#059669';
        } elseif ($work->is_rescheduled) {
            return '#d97706';
        }
        return '#2563eb';
    }
}
