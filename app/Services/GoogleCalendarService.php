<?php

namespace App\Services;

use Google\Client;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Google\Service\Calendar\EventDateTime;
use App\Models\Work;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class GoogleCalendarService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->setRedirectUri(config('services.google.redirect_uri'));
        $this->client->addScope(Calendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function authenticate($code)
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);

        if (isset($token['error'])) {
            throw new Exception('Error fetching access token: ' . $token['error']);
        }

        return $token;
    }

    public function setAccessToken($token)
    {
        $this->client->setAccessToken($token);

        // Check if token is expired and refresh
        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $newToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());

                if (isset($newToken['error'])) {
                    throw new Exception('Error refreshing token: ' . $newToken['error']);
                }

                $this->client->setAccessToken($newToken);
                $this->service = new Calendar($this->client);
                return $newToken;
            } else {
                throw new Exception('No refresh token available. Please reconnect Google Calendar.');
            }
        }

        $this->service = new Calendar($this->client);
        return null;
    }

    public function createEvent(Work $work)
    {
        if (!$this->service) {
            throw new Exception('Calendar service not initialized');
        }

        // Build start and end datetime
        $startDateTime = $work->start_datetime
            ? Carbon::parse($work->start_datetime)
            : Carbon::parse($work->work_date . ' ' . ($work->time ?? '09:00:00'));

        $endDateTime = $work->end_datetime
            ? Carbon::parse($work->end_datetime)
            : $startDateTime->copy()->addHour();

        $event = new Event([
            'summary' => $work->title,
            'description' => $this->buildDescription($work),
            'location' => $work->location,
            'start' => [
                'dateTime' => $startDateTime->toRfc3339String(),
                'timeZone' => config('app.timezone', 'Asia/Dhaka'),
            ],
            'end' => [
                'dateTime' => $endDateTime->toRfc3339String(),
                'timeZone' => config('app.timezone', 'Asia/Dhaka'),
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 30],
                ],
            ],
            'colorId' => $this->getColorId($work),
        ]);

        try {
            $createdEvent = $this->service->events->insert(
                config('services.google.calendar_id', 'primary'),
                $event
            );

            Log::info('Google Calendar event created', [
                'work_id' => $work->id,
                'event_id' => $createdEvent->getId()
            ]);

            return $createdEvent->getId();
        } catch (Exception $e) {
            Log::error('Google Calendar Create Error', [
                'work_id' => $work->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    public function updateEvent(Work $work)
    {
        if (!$this->service || !$work->google_event_id) {
            throw new Exception('Service not initialized or no event ID');
        }

        try {
            $calendarId = config('services.google.calendar_id', 'primary');
            $event = $this->service->events->get($calendarId, $work->google_event_id);

            $startDateTime = $work->start_datetime
                ? Carbon::parse($work->start_datetime)
                : Carbon::parse($work->work_date . ' ' . ($work->time ?? '09:00:00'));

            $endDateTime = $work->end_datetime
                ? Carbon::parse($work->end_datetime)
                : $startDateTime->copy()->addHour();

            $event->setSummary($work->title);
            $event->setDescription($this->buildDescription($work));
            $event->setLocation($work->location);

            $start = new EventDateTime();
            $start->setDateTime($startDateTime->toRfc3339String());
            $start->setTimeZone(config('app.timezone', 'Asia/Dhaka'));
            $event->setStart($start);

            $end = new EventDateTime();
            $end->setDateTime($endDateTime->toRfc3339String());
            $end->setTimeZone(config('app.timezone', 'Asia/Dhaka'));
            $event->setEnd($end);

            $event->setColorId($this->getColorId($work));

            $this->service->events->update($calendarId, $event->getId(), $event);

            Log::info('Google Calendar event updated', [
                'work_id' => $work->id,
                'event_id' => $work->google_event_id
            ]);

            return true;
        } catch (Exception $e) {
            Log::error('Google Calendar Update Error', [
                'work_id' => $work->id,
                'event_id' => $work->google_event_id,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    public function deleteEvent($eventId)
    {
        if (!$this->service || !$eventId) {
            return false;
        }

        try {
            $calendarId = config('services.google.calendar_id', 'primary');
            $this->service->events->delete($calendarId, $eventId);

            Log::info('Google Calendar event deleted', ['event_id' => $eventId]);
            return true;
        } catch (Exception $e) {
            Log::error('Google Calendar Delete Error', [
                'event_id' => $eventId,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    public function listEvents($startDate = null, $endDate = null)
    {
        if (!$this->service) {
            throw new Exception('Calendar service not initialized');
        }

        try {
            $optParams = [
                'maxResults' => 2500,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => $startDate
                    ? Carbon::parse($startDate)->toRfc3339String()
                    : Carbon::now()->startOfMonth()->toRfc3339String(),
                'timeMax' => $endDate
                    ? Carbon::parse($endDate)->toRfc3339String()
                    : Carbon::now()->endOfMonth()->toRfc3339String(),
            ];

            $calendarId = config('services.google.calendar_id', 'primary');
            $results = $this->service->events->listEvents($calendarId, $optParams);

            Log::info('Google Calendar events fetched', [
                'count' => count($results->getItems())
            ]);

            return $results->getItems();
        } catch (Exception $e) {
            Log::error('Google Calendar List Error', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    private function buildDescription(Work $work)
    {
        $description = $work->description ?? '';

        if ($work->note) {
            $description .= "\n\nNote: " . $work->note;
        }

        if ($work->team) {
            $description .= "\n\nTeam: " . $work->team->name;
        }

        if ($work->category) {
            $description .= "\nCategory: " . $work->category->name;
        }

        return $description;
    }

    private function getColorId(Work $work)
    {
        // Google Calendar color IDs
        // 10 = Green (Completed)
        // 5 = Yellow (Rescheduled)
        // 9 = Blue (Pending)
        if ($work->is_completed) {
            return '10'; // Green
        } elseif ($work->is_rescheduled) {
            return '5'; // Yellow
        }
        return '9'; // Blue
    }
}
