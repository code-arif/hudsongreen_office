<?php

namespace App\Http\Controllers\Calendar;

use Exception;
use App\Models\Work;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\GoogleCalendarService;
use Illuminate\Support\Facades\Validator;

class EventManageGoogleController extends Controller
{
    protected $googleCalendar;

    // serivce injection
    public function __construct(GoogleCalendarService $googleCalendar)
    {
        $this->googleCalendar = $googleCalendar;
    }

    //work store and sync with google calendar
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'title'         => 'required|string|max:255',
                'description'   => 'nullable|string',
                'location'      => 'nullable|string',
                'latitude'      => 'nullable|numeric|between:-90,90',
                'longitude'     => 'nullable|numeric|between:-180,180',
                'start_time'    => 'nullable|date_format:h:i A',
                'end_time'      => 'nullable|date_format:h:i A',
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

    // work update and sync with google calendar
    public function update(Request $request, Work $work)
    {
        DB::beginTransaction();

        try {
            $validator = Validator::make($request->all(), [
                'title'         => 'required|string|max:255',
                'description'   => 'nullable|string',
                'location'      => 'nullable|string',
                'latitude'      => 'nullable|numeric|between:-90,90',
                'longitude'     => 'nullable|numeric|between:-180,180',
                'start_time'    => 'nullable|date_format:h:i A',
                'end_time'      => 'nullable|date_format:h:i A',
                'work_date'     => 'required|date',
                'is_all_day'    => 'nullable|boolean',
                'team_id'       => 'nullable|exists:teams,id',
                'category_id'   => 'nullable|exists:categories,id',
                'category_name' => 'nullable|string|max:255',
                'note'          => 'nullable|string',
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
                $category = Category::firstOrCreate(
                    ['name' => $request->category_name],
                    ['name' => $request->category_name]
                );
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
                'note'            => $request->note,
            ]);

            // Google Calendar Sync (if user has connected Google and event exists)
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
                    $googleService->updateEvent($work);

                    // Update sync timestamp
                    $work->update([
                        'google_synced_at' => now(),
                    ]);

                    Log::info('Work updated in Google Calendar', [
                        'work_id' => $work->id,
                        'google_event_id' => $work->google_event_id
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
                'data'    => $work->load(['team', 'category']),
            ], 200);
        } catch (Exception $e) {
            DB::rollBack();

            Log::error('Error updating work', [
                'work_id' => $work->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'status' => false,
                'message' => 'Failed to update work: ' . $e->getMessage()
            ], 500);
        }
    }

    // delete
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
}
