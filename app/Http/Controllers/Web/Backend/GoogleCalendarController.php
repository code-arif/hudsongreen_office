<?php

namespace App\Http\Controllers\Web\Backend;

use Illuminate\Http\Request;
use Google_Client;
use Google_Service_Calendar;
use App\Models\Team;
use App\Models\Work;
use Carbon\Carbon;
use Spatie\GoogleCalendar\Event;

class GoogleCalendarController extends Controller
{
    public function redirectToGoogle()
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));
        $client->addScope(Google_Service_Calendar::CALENDAR);
        $client->setAccessType('offline');
        $client->setApprovalPrompt('force');

        $authUrl = $client->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        $client = new Google_Client();
        $client->setClientId(env('GOOGLE_CLIENT_ID'));
        $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $client->setRedirectUri(env('GOOGLE_REDIRECT_URI'));

        if ($request->get('code')) {
            $token = $client->fetchAccessTokenWithAuthCode($request->get('code'));
            $client->setAccessToken($token);

            // Store token in session
            session(['google_token' => $token]);

            // Redirect back to the last page or a specific page
            return redirect()->back()->with('success', 'Google Calendar connected successfully!');
        }

        return redirect()->route('dashboard')->with('error', 'Failed to connect to Google Calendar.');
    }

    public function syncTeamWorks(Request $request, $teamId)
    {
        if (!session()->has('google_token')) {
            return response()->json([
                'status' => false,
                'message' => 'Google account not connected.',
                'redirect' => route('google.auth')
            ]);
        }

        $client = new Google_Client();
        $client->setAccessToken(session('google_token'));

        // Refresh token if expired
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            session(['google_token' => $client->getAccessToken()]);
        }

        config(['google-calendar.client' => $client]);

        $team = Team::findOrFail($teamId);
        $works = Work::where('team_id', $teamId)->whereNotNull('work_date')->get();

        foreach ($works as $work) {
            $startTime = Carbon::parse($work->work_date . ' ' . $work->start_time, 'Asia/Dhaka');
            $endTime = Carbon::parse($work->work_date . ' ' . $work->end_time, 'Asia/Dhaka');

            // Event data
            $eventData = [
                'name' => $work->title,
                'description' => $work->description ?? 'No description',
                'location' => $work->location ?? 'Not specified',
                'startDateTime' => $startTime,
                'endDateTime' => $endTime,
            ];

            try {
                if ($work->google_event_id) {
                    // Update existing event
                    $event = Event::find($work->google_event_id);
                    $event->update($eventData);
                } else {
                    // Create new event
                    $event = Event::create($eventData);
                    $work->google_event_id = $event->id;
                    $work->save();
                }
            } catch (\Exception $e) {
                // Handle exceptions, e.g., event not found on Google Calendar
                // For simplicity, we create a new one if find fails
                 try {
                    $event = Event::create($eventData);
                    $work->google_event_id = $event->id;
                    $work->save();
                 } catch (\Exception $ex) {
                    // Log error if creation also fails
                    \Log::error('Google Calendar Sync Error: ' . $ex->getMessage());
                 }
            }
        }

        return response()->json([
            'status' => true,
            'message' => 'All works have been synced to Google Calendar successfully!'
        ]);
    }
}
