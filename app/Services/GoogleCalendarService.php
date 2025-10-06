<?php

namespace App\Services;

use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Google_Service_Calendar_EventDateTime;
use Illuminate\Support\Facades\Session;

class GoogleCalendarService
{
    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(config('google-calendar.client_id'));
        $this->client->setClientSecret(config('google-calendar.client_secret'));
        $this->client->setRedirectUri(config('google-calendar.redirect_uri'));
        $this->client->addScope(Google_Service_Calendar::CALENDAR);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('consent');

        if (Session::has('google_token')) {
            $this->client->setAccessToken(Session::get('google_token'));

            if ($this->client->isAccessTokenExpired()) {
                if ($this->client->getRefreshToken()) {
                    $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
                    Session::put('google_token', $this->client->getAccessToken());
                }
            }
        }

        $this->service = new Google_Service_Calendar($this->client);
    }

    public function getAuthUrl()
    {
        return $this->client->createAuthUrl();
    }

    public function authenticate($code)
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);
        Session::put('google_token', $token);
        return $token;
    }

    public function isAuthenticated()
    {
        return Session::has('google_token') && !$this->client->isAccessTokenExpired();
    }

    public function createEvent($work)
    {
        $event = new Google_Service_Calendar_Event([
            'summary' => $work->title,
            'description' => strip_tags($work->description),
            'location' => $work->location,
        ]);

        if ($work->start_time && $work->end_time) {
            $start = new Google_Service_Calendar_EventDateTime([
                'dateTime' => $work->work_date . 'T' . $work->start_time,
                'timeZone' => 'Asia/Dhaka',
            ]);
            $end = new Google_Service_Calendar_EventDateTime([
                'dateTime' => $work->work_date . 'T' . $work->end_time,
                'timeZone' => 'Asia/Dhaka',
            ]);
        } else {
            $start = new Google_Service_Calendar_EventDateTime([
                'date' => $work->work_date,
                'timeZone' => 'Asia/Dhaka',
            ]);
            $end = new Google_Service_Calendar_EventDateTime([
                'date' => $work->work_date,
                'timeZone' => 'Asia/Dhaka',
            ]);
        }

        $event->setStart($start);
        $event->setEnd($end);

        $calendarId = config('google-calendar.calendar_id');
        return $this->service->events->insert($calendarId, $event);
    }

    public function getEvents($timeMin = null, $timeMax = null)
    {
        $calendarId = config('google-calendar.calendar_id');

        $optParams = [
            'orderBy' => 'startTime',
            'singleEvents' => true,
            'timeMin' => $timeMin ?? date('c'),
            'timeMax' => $timeMax,
        ];

        $results = $this->service->events->listEvents($calendarId, $optParams);
        return $results->getItems();
    }

    public function updateEvent($eventId, $work)
    {
        $calendarId = config('google-calendar.calendar_id');
        $event = $this->service->events->get($calendarId, $eventId);

        $event->setSummary($work->title);
        $event->setDescription(strip_tags($work->description));
        $event->setLocation($work->location);

        if ($work->start_time && $work->end_time) {
            $start = new Google_Service_Calendar_EventDateTime([
                'dateTime' => $work->work_date . 'T' . $work->start_time,
                'timeZone' => 'Asia/Dhaka',
            ]);
            $end = new Google_Service_Calendar_EventDateTime([
                'dateTime' => $work->work_date . 'T' . $work->end_time,
                'timeZone' => 'Asia/Dhaka',
            ]);
            $event->setStart($start);
            $event->setEnd($end);
        }

        return $this->service->events->update($calendarId, $eventId, $event);
    }

    public function deleteEvent($eventId)
    {
        $calendarId = config('google-calendar.calendar_id');
        return $this->service->events->delete($calendarId, $eventId);
    }
}
