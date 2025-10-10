<?php

namespace App\Services;

use Exception;
use Carbon\Carbon;
use Google\Client;
use App\Models\Work;
use Google\Service\Calendar;
use Google\Service\Calendar\Event;
use Illuminate\Support\Facades\Log;
use Google\Service\Calendar\EventDateTime;

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

        if ($this->client->isAccessTokenExpired()) {
            if ($this->client->getRefreshToken()) {
                $newToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                return $newToken;
            }
        }

        $this->service = new Calendar($this->client);
        return null;
    }

    public function createEvent(Work $work)
    {
        if (!$this->service) {
            return null;
        }

        $event = new Event([
            'summary' => $work->title,
            'description' => $work->description,
            'location' => $work->location,
            'start' => [
                'dateTime' => Carbon::parse($work->start_datetime)->toRfc3339String(),
                'timeZone' => config('app.timezone'),
            ],
            'end' => [
                'dateTime' => Carbon::parse($work->end_datetime)->toRfc3339String(),
                'timeZone' => config('app.timezone'),
            ],
            'reminders' => [
                'useDefault' => false,
                'overrides' => [
                    ['method' => 'email', 'minutes' => 24 * 60],
                    ['method' => 'popup', 'minutes' => 30],
                ],
            ],
            'colorId' => $work->is_completed ? '10' : ($work->is_rescheduled ? '5' : '11'),
        ]);

        try {
            $createdEvent = $this->service->events->insert(config('services.google.calendar_id'), $event);
            return $createdEvent->getId();
        } catch (Exception $e) {
            Log::error('Google Calendar Create Error: ' . $e->getMessage());
            return null;
        }
    }

    public function updateEvent(Work $work)
    {
        if (!$this->service || !$work->google_event_id) {
            return false;
        }

        try {
            $event = $this->service->events->get(config('services.google.calendar_id'), $work->google_event_id);

            $event->setSummary($work->title);
            $event->setDescription($work->description);
            $event->setLocation($work->location);

            $start = new EventDateTime();
            $start->setDateTime(Carbon::parse($work->start_datetime)->toRfc3339String());
            $start->setTimeZone(config('app.timezone'));
            $event->setStart($start);

            $end = new EventDateTime();
            $end->setDateTime(Carbon::parse($work->end_datetime)->toRfc3339String());
            $end->setTimeZone(config('app.timezone'));
            $event->setEnd($end);

            $event->setColorId($work->is_completed ? '10' : ($work->is_rescheduled ? '5' : '11'));

            $this->service->events->update(config('services.google.calendar_id'), $event->getId(), $event);
            return true;
        } catch (Exception $e) {
            Log::error('Google Calendar Update Error: ' . $e->getMessage());
            return false;
        }
    }

    public function deleteEvent($eventId)
    {
        if (!$this->service || !$eventId) {
            return false;
        }

        try {
            $this->service->events->delete(config('services.google.calendar_id'), $eventId);
            return true;
        } catch (Exception $e) {
            Log::error('Google Calendar Delete Error: ' . $e->getMessage());
            return false;
        }
    }

    public function listEvents($startDate = null, $endDate = null)
    {
        if (!$this->service) {
            return [];
        }

        try {
            $optParams = [
                'maxResults' => 100,
                'orderBy' => 'startTime',
                'singleEvents' => true,
                'timeMin' => $startDate ? Carbon::parse($startDate)->toRfc3339String() : Carbon::now()->startOfMonth()->toRfc3339String(),
                'timeMax' => $endDate ? Carbon::parse($endDate)->toRfc3339String() : Carbon::now()->endOfMonth()->toRfc3339String(),
            ];

            $results = $this->service->events->listEvents(config('services.google.calendar_id'), $optParams);
            return $results->getItems();
        } catch (Exception $e) {
            Log::error('Google Calendar List Error: ' . $e->getMessage());
            return [];
        }
    }
}
