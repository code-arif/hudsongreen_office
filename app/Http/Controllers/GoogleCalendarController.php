<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\Work;
use App\Models\Category;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleCalendarService;

class GoogleCalendarController extends Controller
{
    protected $googleCalendar;

    // serivce injection
    public function __construct(GoogleCalendarService $googleCalendar)
    {
        $this->googleCalendar = $googleCalendar;
    }

    // show calendar view
    public function index(Request $request)
    {
        $teams = Team::all();
        $categories = Category::all();
        $user = Auth::user();

        $isGoogleConnected = !empty($user->google_access_token);

        return view('backend.layouts.calendar.index', compact('teams', 'categories', 'isGoogleConnected'));
    }

    //
    // fetch events for calendar
    // public function getEvents(Request $request)
    // {
    //     try {
    //         $start = $request->get('start');
    //         $end = $request->get('end');
    //         $teamId = $request->get('team_id');
    //         $status = $request->get('status');
    //         $categoryId = $request->get('category_id');

    //         $query = Work::with(['team', 'category']);

    //         // Date range filter
    //         if ($start && $end) {
    //             $query->whereBetween('work_date', [
    //                 Carbon::parse($start)->startOfDay(),
    //                 Carbon::parse($end)->endOfDay()
    //             ]);
    //         }

    //         // Team filter
    //         if ($teamId) {
    //             $query->where('team_id', $teamId);
    //         }

    //         // Status filter
    //         if ($status === 'completed') {
    //             $query->where('is_completed', true);
    //         } elseif ($status === 'pending') {
    //             $query->where('is_completed', false);
    //         } elseif ($status === 'rescheduled') {
    //             $query->where('is_rescheduled', true);
    //         }

    //         // Category filter
    //         if ($categoryId) {
    //             $query->where('category_id', $categoryId);
    //         }

    //         $works = $query->get();

    //         $events = $works->map(function ($work) {
    //             try {
    //                 $workDate = Carbon::parse($work->work_date);
    //                 $timeStr = $work->time ?? '09:00:00';

    //                 $startDateTime = Carbon::parse($workDate->format('Y-m-d') . ' ' . $timeStr);
    //                 $endDateTime = $startDateTime->copy()->addHour();

    //                 return [
    //                     'id' => $work->id,
    //                     'title' => $work->title,
    //                     'start' => $startDateTime->toIso8601String(),
    //                     'end' => $endDateTime->toIso8601String(),
    //                     'description' => $work->description,
    //                     'location' => $work->location,
    //                     'backgroundColor' => $this->getEventColor($work),
    //                     'borderColor' => $this->getEventBorderColor($work),
    //                     'extendedProps' => [
    //                         'team' => $work->team ? $work->team->name : null,
    //                         'category' => $work->category ? $work->category->name : null,
    //                         'completed' => $work->is_completed,
    //                         'rescheduled' => $work->is_rescheduled,
    //                         'latitude' => $work->latitude,
    //                         'longitude' => $work->longitude,
    //                         'note' => $work->note,
    //                         'google_event_id' => $work->google_event_id,
    //                     ],
    //                 ];
    //             } catch (Exception $e) {
    //                 Log::error('Error processing work for calendar', [
    //                     'work_id' => $work->id,
    //                     'error' => $e->getMessage()
    //                 ]);
    //                 return null;
    //             }
    //         })->filter()->values();

    //         return response()->json($events);
    //     } catch (Exception $e) {
    //         Log::error('getEvents error', [
    //             'message' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         return response()->json([
    //             'error' => 'Failed to load events',
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    public function getEvents(Request $request)
    {
        try {
            $start = $request->get('start');
            $end = $request->get('end');
            $teamId = $request->get('team_id');
            $status = $request->get('status');
            $categoryId = $request->get('category_id');

            $query = Work::with(['team', 'category']);

            // Date range filter - UPDATED for new schema
            if ($start && $end) {
                $query->whereBetween('start_datetime', [
                    Carbon::parse($start)->startOfDay(),
                    Carbon::parse($end)->endOfDay()
                ]);
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
                    // Handle both all-day and timed events
                    if ($work->is_all_day) {
                        return [
                            'id' => $work->id,
                            'title' => $work->title,
                            'start' => Carbon::parse($work->start_datetime)->toDateString(),
                            'end' => Carbon::parse($work->end_datetime)->toDateString(),
                            'allDay' => true,
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
                                'is_all_day' => true,
                            ],
                        ];
                    } else {
                        return [
                            'id' => $work->id,
                            'title' => $work->title,
                            'start' => Carbon::parse($work->start_datetime)->toIso8601String(),
                            'end' => Carbon::parse($work->end_datetime)->toIso8601String(),
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
                                'is_all_day' => false,
                            ],
                        ];
                    }
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

    // store new work
    // public function store(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'nullable|string',
    //             'location' => 'nullable|string|max:255',
    //             'latitude' => 'nullable|numeric',
    //             'longitude' => 'nullable|numeric',
    //             'time' => 'required',
    //             'work_date' => 'required|date',
    //             'team_id' => 'nullable|exists:teams,id',
    //             'category_id' => 'nullable|exists:categories,id',
    //             'category_name' => 'nullable|string|max:255',
    //             'note' => 'nullable|string',
    //         ]);

    //         // Handle new category creation if category_id is empty
    //         if (empty($validated['category_id']) && !empty($validated['category_name'])) {
    //             $category = Category::create([
    //                 'name' => $validated['category_name'],
    //             ]);
    //             $validated['category_id'] = $category->id;
    //         }

    //         // Remove category_name so it doesn’t interfere with mass assignment
    //         unset($validated['category_name']);

    //         $work = Work::create($validated);

    //         // Sync to Google Calendar
    //         if (Auth::user()->google_access_token) {
    //             try {
    //                 $this->syncWorkToGoogle($work);
    //             } catch (Exception $e) {
    //                 Log::error('Failed to sync to Google Calendar', [
    //                     'work_id' => $work->id,
    //                     'error' => $e->getMessage()
    //                 ]);
    //             }
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Work schedule created successfully!',
    //             'work' => $work->load(['team', 'category'])
    //         ]);
    //     } catch (Exception $e) {
    //         Log::error('Error creating work', [
    //             'error' => $e->getMessage(),
    //             'trace' => $e->getTraceAsString()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to create work: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    // store new work - UPDATED
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'start_datetime' => 'required|date',
                'end_datetime' => 'required|date|after:start_datetime',
                'is_all_day' => 'boolean',
                'team_id' => 'nullable|exists:teams,id',
                'category_id' => 'nullable|exists:categories,id',
                'category_name' => 'nullable|string|max:255',
                'note' => 'nullable|string',
            ]);

            // Handle new category creation
            if (empty($validated['category_id']) && !empty($validated['category_name'])) {
                $category = Category::create([
                    'name' => $validated['category_name'],
                ]);
                $validated['category_id'] = $category->id;
            }

            unset($validated['category_name']);

            // Ensure is_all_day is set
            $validated['is_all_day'] = $validated['is_all_day'] ?? false;

            $work = Work::create($validated);

            // Sync to Google Calendar
            if (Auth::user()->google_access_token) {
                try {
                    $this->syncWorkToGoogle($work);
                } catch (Exception $e) {
                    Log::error('Failed to sync to Google Calendar', [
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

    // show work details
    public function show(Work $work)
    {
        $work->load(['team', 'category']);
        return response()->json($work);
    }

    // update work
    // public function update(Request $request, Work $work)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'title' => 'required|string|max:255',
    //             'description' => 'nullable|string',
    //             'location' => 'nullable|string|max:255',
    //             'latitude' => 'nullable|numeric',
    //             'longitude' => 'nullable|numeric',
    //             'time' => 'required',
    //             'work_date' => 'required|date',
    //             'team_id' => 'nullable|exists:teams,id',
    //             'category_id' => 'nullable|exists:categories,id',
    //             'category_name' => 'nullable|string|max:255',
    //             'note' => 'nullable|string',
    //         ]);

    //         // Handle new category creation if no category_id is selected
    //         if (empty($validated['category_id']) && !empty($validated['category_name'])) {
    //             $category = Category::create([
    //                 'name' => $validated['category_name'],
    //             ]);
    //             $validated['category_id'] = $category->id;
    //         }

    //         // Remove temporary input
    //         unset($validated['category_name']);

    //         $work->update($validated);

    //         // ✅ Update Google Calendar (unchanged)
    //         if (Auth::user()->google_access_token && $work->google_event_id) {
    //             try {
    //                 $this->syncWorkToGoogle($work, true);
    //             } catch (Exception $e) {
    //                 Log::warning('Failed to update Google Calendar', [
    //                     'work_id' => $work->id,
    //                     'error' => $e->getMessage()
    //                 ]);
    //             }
    //         }

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Work schedule updated successfully!',
    //             'work' => $work->load(['team', 'category'])
    //         ]);
    //     } catch (Exception $e) {
    //         Log::error('Error updating work', [
    //             'work_id' => $work->id,
    //             'error' => $e->getMessage()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to update work: ' . $e->getMessage()
    //         ], 500);
    //     }
    // }

    // update work - UPDATED
    public function update(Request $request, Work $work)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'location' => 'nullable|string|max:255',
                'latitude' => 'nullable|numeric',
                'longitude' => 'nullable|numeric',
                'start_datetime' => 'required|date',
                'end_datetime' => 'required|date|after:start_datetime',
                'is_all_day' => 'boolean',
                'team_id' => 'nullable|exists:teams,id',
                'category_id' => 'nullable|exists:categories,id',
                'category_name' => 'nullable|string|max:255',
                'note' => 'nullable|string',
            ]);

            // Handle new category creation
            if (empty($validated['category_id']) && !empty($validated['category_name'])) {
                $category = Category::create([
                    'name' => $validated['category_name'],
                ]);
                $validated['category_id'] = $category->id;
            }

            unset($validated['category_name']);

            // Ensure is_all_day is set
            $validated['is_all_day'] = $validated['is_all_day'] ?? false;

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

    // delete work
    // public function destroy(Work $work)
    // {
    //     try {
    //         // Delete from Google Calendar
    //         if (Auth::user()->google_access_token && $work->google_event_id) {
    //             try {
    //                 $token = json_decode(Auth::user()->google_access_token, true);
    //                 $this->googleCalendar->setAccessToken($token);
    //                 $this->googleCalendar->deleteEvent($work->google_event_id);
    //             } catch (Exception $e) {
    //                 Log::warning('Failed to delete from Google Calendar', [
    //                     'work_id' => $work->id,
    //                     'error' => $e->getMessage()
    //                 ]);
    //             }
    //         }

    //         $work->delete();

    //         return response()->json([
    //             'success' => true,
    //             'message' => 'Work schedule deleted successfully!'
    //         ]);
    //     } catch (Exception $e) {
    //         Log::error('Error deleting work', [
    //             'work_id' => $work->id,
    //             'error' => $e->getMessage()
    //         ]);

    //         return response()->json([
    //             'success' => false,
    //             'message' => 'Failed to delete work'
    //         ], 500);
    //     }
    // }
    // delete work - UPDATED with proper token refresh
    public function destroy(Work $work)
    {
        try {
            // Delete from Google Calendar first
            if (Auth::user()->google_access_token && $work->google_event_id) {
                try {
                    $token = json_decode(Auth::user()->google_access_token, true);

                    // Set token and handle refresh
                    $newToken = $this->googleCalendar->setAccessToken($token);

                    // Update token if refreshed
                    if ($newToken) {
                        Auth::user()->update([
                            'google_access_token' => json_encode($newToken)
                        ]);
                    }

                    // Delete the event
                    $this->googleCalendar->deleteEvent($work->google_event_id);

                    Log::info('Google Calendar event deleted successfully', [
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
                    // Continue with local deletion
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


    // redirect to google for auth
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

    // handle google callback after auth
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

            // Log::info('Google Calendar connected', ['user_id' => $user->id]);
            // Log::channel('single')->info('Google Calendar connected', ['user_id' => $user->id]);

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

    // disconnet google calendar
    public function disconnect()
    {
        try {
            $user = Auth::user();
            $user->google_access_token = null;
            $user->google_refresh_token = null;
            $user->google_token_expires_at = null;
            $user->save();

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

    // sync from google calendar - UPDATED
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
                $googleEventId = $event->getId();
                $existingWork = Work::where('google_event_id', $googleEventId)->first();

                // Handle all-day events
                $isAllDay = false;
                $startDateTime = null;
                $endDateTime = null;

                if ($event->getStart()->getDate()) {
                    // All-day event
                    $isAllDay = true;
                    $startDateTime = Carbon::parse($event->getStart()->getDate())->startOfDay();
                    $endDateTime = Carbon::parse($event->getEnd()->getDate())->startOfDay();
                } elseif ($event->getStart()->getDateTime()) {
                    // Timed event
                    $startDateTime = Carbon::parse($event->getStart()->getDateTime());
                    $endDateTime = Carbon::parse($event->getEnd()->getDateTime());
                } else {
                    // Skip events without proper datetime
                    continue;
                }

                $workData = [
                    'title' => $event->getSummary() ?? 'Untitled Event',
                    'description' => $event->getDescription(),
                    'location' => $event->getLocation(),
                    'start_datetime' => $startDateTime,
                    'end_datetime' => $endDateTime,
                    'is_all_day' => $isAllDay,
                    'google_event_id' => $googleEventId,
                    'google_synced_at' => Carbon::now(),
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

    // sync single work to google calendar - UPDATED
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
                $work->google_synced_at = Carbon::now();
                $work->save();
            } else {
                $eventId = $this->googleCalendar->createEvent($work);
                if ($eventId) {
                    $work->google_event_id = $eventId;
                    $work->google_synced_at = Carbon::now();
                    $work->save();
                }
            }
        } catch (Exception $e) {
            Log::error('Sync to Google Error', [
                'work_id' => $work->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    // event color based on status
    private function getEventColor($work)
    {
        if ($work->is_completed) {
            return '#10b981';
        } elseif ($work->is_rescheduled) {
            return '#f59e0b';
        }
        return '#3b82f6';
    }

    // event border color based on status
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
