<?php

namespace App\Http\Controllers\Calendar;

use Exception;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleCalendarService;

class SyncEventFromGoogleController extends Controller
{
    protected $googleCalendar;

    // serivce injection
    public function __construct(GoogleCalendarService $googleCalendar)
    {
        $this->googleCalendar = $googleCalendar;
    }

    // sync 3 month ago and ahed work form google calendar
    public function syncFromGoogle(Request $request)
    {
        try {
            $user = Auth::user();

            if (empty($user->google_access_token)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Google Calendar not connected or token missing'
                ], 400);
            }

            Log::info('Starting Google sync', [
                'user_id' => $user->id
            ]);

            // Decode token
            // $token = json_decode($user->google_access_token, true);

            // if (json_last_error() !== JSON_ERROR_NONE) {
            //     Log::error('Failed to decode token', [
            //         'json_error' => json_last_error_msg(),
            //         'token_preview' => substr($user->google_access_token, 0, 100)
            //     ]);

            //     return response()->json([
            //         'success' => false,
            //         'message' => 'Invalid token format. Please reconnect Google Calendar.'
            //     ], 400);
            // }

            // Decode token
            $token = json_decode($user->google_access_token, true);

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($token)) {
                Log::error('Invalid token format', [
                    'json_error' => json_last_error_msg(),
                    'token_preview' => substr($user->google_access_token, 0, 100)
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid token format. Please reconnect Google Calendar.'
                ], 400);
            }

            // Add refresh token if stored separately
            if (!isset($token['refresh_token']) && $user->google_refresh_token) {
                $token['refresh_token'] = $user->google_refresh_token;
                Log::info('Added refresh token from database');
            }

            Log::info('Token decoded successfully', [
                'has_access_token' => isset($token['access_token']),
                'has_refresh_token' => isset($token['refresh_token']),
                'expires_in' => $token['expires_in'] ?? 'N/A'
            ]);

            // Set access token and handle refresh
            $newToken = $this->googleCalendar->setAccessToken($token);

            // Update token if refreshed
            if ($newToken) {
                Log::info('Token was refreshed, updating database');

                $user->google_access_token = json_encode($newToken);

                if (isset($newToken['refresh_token'])) {
                    $user->google_refresh_token = $newToken['refresh_token'];
                }

                if (isset($newToken['expires_in'])) {
                    $user->google_token_expires_at = Carbon::now()->addSeconds($newToken['expires_in']);
                }

                $user->save();

                Log::info('Updated token saved to database');
            }

            // Extended date range: 3 months back, 3 months forward
            $startDate = $request->get('start')
                ? Carbon::parse($request->get('start'))
                : Carbon::now()->subMonths(3)->startOfMonth();

            $endDate = $request->get('end')
                ? Carbon::parse($request->get('end'))
                : Carbon::now()->addMonths(3)->endOfMonth();

            Log::info('Fetching events from Google', [
                'start_date' => $startDate->toDateTimeString(),
                'end_date' => $endDate->toDateTimeString()
            ]);

            $events = $this->googleCalendar->listEvents($startDate, $endDate);

            Log::info('Events fetched from Google', [
                'count' => count($events)
            ]);

            $syncedCount = 0;
            $updatedCount = 0;
            $skippedCount = 0;

            foreach ($events as $event) {
                try {
                    $googleEventId = $event->getId();

                    // Skip cancelled events
                    if ($event->getStatus() === 'cancelled') {
                        $skippedCount++;
                        continue;
                    }

                    $existingWork = Work::where('google_event_id', $googleEventId)->first();

                    // Handle all-day events
                    $isAllDay = false;
                    $startDateTime = null;
                    $endDateTime = null;

                    if ($event->getStart()->getDate()) {
                        // All-day event
                        $isAllDay = true;
                        $startDateTime = Carbon::parse($event->getStart()->getDate())->startOfDay();
                        $endDateTime = Carbon::parse($event->getEnd()->getDate())->subDay()->endOfDay();
                    } elseif ($event->getStart()->getDateTime()) {
                        // Timed event
                        $startDateTime = Carbon::parse($event->getStart()->getDateTime());
                        $endDateTime = Carbon::parse($event->getEnd()->getDateTime());
                    } else {
                        $skippedCount++;
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
                } catch (Exception $e) {
                    Log::error('Error syncing individual event', [
                        'event_id' => $event->getId(),
                        'error' => $e->getMessage()
                    ]);
                    $skippedCount++;
                }
            }

            $message = "Successfully synced from Google Calendar! ";
            $message .= "New: {$syncedCount}, Updated: {$updatedCount}";
            if ($skippedCount > 0) {
                $message .= ", Skipped: {$skippedCount}";
            }

            Log::info('Sync completed successfully', [
                'synced' => $syncedCount,
                'updated' => $updatedCount,
                'skipped' => $skippedCount
            ]);

            return response()->json([
                'success' => true,
                'message' => $message,
                'synced' => $syncedCount,
                'updated' => $updatedCount,
                'skipped' => $skippedCount
            ]);
        } catch (Exception $e) {
            Log::error('Google Sync Error', [
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Sync failed: ' . $e->getMessage()
            ], 500);
        }
    }
}
