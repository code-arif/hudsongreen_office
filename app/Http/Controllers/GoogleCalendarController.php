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

    public function __construct(GoogleCalendarService $googleCalendar)
    {
        $this->googleCalendar = $googleCalendar;
    }

    public function index(Request $request)
    {
        $teams = Team::all();
        $categories = Category::all();
        $user = Auth::user();

        $isGoogleConnected = !empty($user->google_access_token);

        return view('backend.layouts.calendar.index', compact('teams', 'categories', 'isGoogleConnected'));
    }

    public function getEvents(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');
        $teamId = $request->get('team_id');
        $status = $request->get('status');

        $query = Work::with(['team', 'category'])
            ->whereBetween('work_date', [Carbon::parse($start)->startOfDay(), Carbon::parse($end)->endOfDay()])
            ->when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->when($status === 'completed', fn($q) => $q->where('is_completed', true))
            ->when($status === 'pending', fn($q) => $q->where('is_completed', false));

        $works = $query->get();

        $events = $works->map(function ($work) {
            $startDateTime = Carbon::parse($work->work_date . ' ' . $work->time);
            $endDateTime = $work->end_datetime ? Carbon::parse($work->end_datetime) : $startDateTime->copy()->addHour();

            return [
                'id' => $work->id,
                'title' => $work->title,
                // 'start' => $startDateTime->toIso8601String(),
                // 'end' => $endDateTime->toIso8601String(),
                'description' => $work->description,
                'location' => $work->location,
                'backgroundColor' => $work->is_completed ? '#10b981' : ($work->is_rescheduled ? '#f59e0b' : '#3b82f6'),
                'borderColor' => $work->is_completed ? '#059669' : ($work->is_rescheduled ? '#d97706' : '#2563eb'),
                'extendedProps' => [
                    'team' => $work->team ? $work->team->name : 'No Team',
                    'category' => $work->category ? $work->category->name : 'No Category',
                    'completed' => $work->is_completed,
                    'rescheduled' => $work->is_rescheduled,
                    'latitude' => $work->latitude,
                    'longitude' => $work->longitude,
                    'note' => $work->note,
                ],
            ];
        });

        return response()->json($events);
    }

    public function store(Request $request)
    {
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
        ]);

        $startDateTime = Carbon::parse($validated['work_date'] . ' ' . $validated['time']);
        $endDateTime = isset($validated['end_time'])
            ? Carbon::parse($validated['work_date'] . ' ' . $validated['end_time'])
            : $startDateTime->copy()->addHour();

        $validated['start_datetime'] = $startDateTime;
        $validated['end_datetime'] = $endDateTime;

        $work = Work::create($validated);

        // Sync to Google Calendar
        if (Auth::user()->google_access_token) {
            $this->syncWorkToGoogle($work);
        }

        return response()->json([
            'success' => true,
            'message' => 'Work schedule created successfully!',
            'work' => $work
        ]);
    }

    public function show(Work $work)
    {
        $work->load(['team', 'category']);
        return response()->json($work);
    }

    public function update(Request $request, Work $work)
    {
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
        $endDateTime = isset($validated['end_time'])
            ? Carbon::parse($validated['work_date'] . ' ' . $validated['end_time'])
            : $startDateTime->copy()->addHour();

        $validated['start_datetime'] = $startDateTime;
        $validated['end_datetime'] = $endDateTime;

        $work->update($validated);

        // Update Google Calendar
        if (Auth::user()->google_access_token && $work->google_event_id) {
            $this->syncWorkToGoogle($work, true);
        }

        return response()->json([
            'success' => true,
            'message' => 'Work schedule updated successfully!',
            'work' => $work
        ]);
    }

    public function destroy(Work $work)
    {
        // Delete from Google Calendar
        if (Auth::user()->google_access_token && $work->google_event_id) {
            $token = json_decode(Auth::user()->google_access_token, true);
            $this->googleCalendar->setAccessToken($token);
            $this->googleCalendar->deleteEvent($work->google_event_id);
        }

        $work->delete();

        return response()->json([
            'success' => true,
            'message' => 'Work schedule deleted successfully!'
        ]);
    }

    public function toggleStatus(Request $request, Work $work)
    {
        $work->update(['is_completed' => !$work->is_completed]);

        // Update Google Calendar
        if (Auth::user()->google_access_token && $work->google_event_id) {
            $this->syncWorkToGoogle($work, true);
        }

        return response()->json([
            'success' => true,
            'completed' => $work->is_completed,
            'message' => $work->is_completed ? 'Work marked as completed!' : 'Work marked as pending!'
        ]);
    }

    public function redirectToGoogle()
    {
        $authUrl = $this->googleCalendar->getAuthUrl();
        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $code = $request->get('code');
            $token = $this->googleCalendar->authenticate($code);

            $user = Auth::user();
            $user->google_access_token = json_encode($token);

            if (isset($token['refresh_token'])) {
                $user->google_refresh_token = $token['refresh_token'];
            }

            if (isset($token['expires_in'])) {
                $user->google_token_expires_at = Carbon::now()->addSeconds($token['expires_in']);
            }

            $user->save();

            return redirect()->route('calendar.index')->with('success', 'Google Calendar connected successfully!');
        } catch (Exception $e) {
            return redirect()->route('calendar.index')->with('error', 'Failed to connect Google Calendar: ' . $e->getMessage());
        }
    }

    public function disconnect()
    {
        $user = Auth::user();
        $user->google_access_token = null;
        $user->google_refresh_token = null;
        $user->google_token_expires_at = null;
        $user->save();

        // Remove google_event_id from all works
        Work::whereNotNull('google_event_id')->update(['google_event_id' => null]);

        return redirect()->route('calendar.index')->with('success', 'Google Calendar disconnected successfully!');
    }

    public function syncFromGoogle(Request $request)
    {
        try {
            $user = Auth::user();

            if (!$user->google_access_token) {
                return response()->json(['success' => false, 'message' => 'Google Calendar not connected'], 400);
            }

            $token = json_decode($user->google_access_token, true);
            $newToken = $this->googleCalendar->setAccessToken($token);

            if ($newToken) {
                $user->google_access_token = json_encode($newToken);
                $user->save();
            }

            $startDate = $request->get('start', Carbon::now()->startOfMonth());
            $endDate = $request->get('end', Carbon::now()->endOfMonth());

            $events = $this->googleCalendar->listEvents($startDate, $endDate);

            $syncedCount = 0;
            foreach ($events as $event) {
                $existingWork = Work::where('google_event_id', $event->getId())->first();

                if (!$existingWork && $event->getStart()->getDateTime()) {
                    $startDateTime = Carbon::parse($event->getStart()->getDateTime());
                    $endDateTime = $event->getEnd()->getDateTime()
                        ? Carbon::parse($event->getEnd()->getDateTime())
                        : $startDateTime->copy()->addHour();

                    Work::create([
                        'title' => $event->getSummary() ?? 'Untitled Event',
                        'description' => $event->getDescription(),
                        'location' => $event->getLocation(),
                        'work_date' => $startDateTime->toDateString(),
                        'time' => $startDateTime->toTimeString(),
                        'start_datetime' => $startDateTime,
                        'end_datetime' => $endDateTime,
                        'google_event_id' => $event->getId(),
                    ]);

                    $syncedCount++;
                }
            }

            return response()->json([
                'success' => true,
                'message' => "Synced {$syncedCount} events from Google Calendar",
                'count' => $syncedCount
            ]);
        } catch (Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function syncWorkToGoogle(Work $work, $update = false)
    {
        try {
            $user = Auth::user();
            $token = json_decode($user->google_access_token, true);
            $newToken = $this->googleCalendar->setAccessToken($token);

            if ($newToken) {
                $user->google_access_token = json_encode($newToken);
                $user->save();
            }

            if ($update) {
                $this->googleCalendar->updateEvent($work);
            } else {
                $eventId = $this->googleCalendar->createEvent($work);
                if ($eventId) {
                    $work->google_event_id = $eventId;
                    $work->save();
                }
            }
        } catch (Exception $e) {
            Log::error('Google Calendar Sync Error: ' . $e->getMessage());
        }
    }
}
