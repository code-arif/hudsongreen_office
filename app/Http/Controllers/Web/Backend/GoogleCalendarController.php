<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoogleCalendarService;

class GoogleCalendarController extends Controller
{
    protected $googleCalendar;

    public function __construct(GoogleCalendarService $googleCalendar)
    {
        $this->googleCalendar = $googleCalendar;
    }

    public function redirectToGoogle()
    {
        return redirect()->away($this->googleCalendar->getAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        if ($request->has('code')) {
            $this->googleCalendar->authenticate($request->code);
            return redirect()->route('team.list')->with('success', 'Google Calendar connected successfully!');
        }

        return redirect()->route('team.list')->with('error', 'Failed to connect Google Calendar');
    }

    public function syncWork($id)
    {
        try {
            if (!$this->googleCalendar->isAuthenticated()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Please connect your Google Calendar first',
                    'redirect' => route('google.auth')
                ], 401);
            }

            $work = Work::findOrFail($id);
            $event = $this->googleCalendar->createEvent($work);

            // Save Google event ID in work
            $work->google_event_id = $event->getId();
            $work->save();

            return response()->json([
                'status' => true,
                'message' => 'Work synced to Google Calendar successfully!',
                'event_id' => $event->getId()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to sync: ' . $e->getMessage()
            ], 500);
        }
    }
}
