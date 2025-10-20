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
}
