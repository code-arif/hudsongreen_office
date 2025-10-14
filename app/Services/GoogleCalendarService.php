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
    protected $calendar;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setApplicationName(config('app.name'));
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

    // exchange auth code for access token
    public function authenticate($code)
    {
        $token = $this->client->fetchAccessTokenWithAuthCode($code);

        if (isset($token['error'])) {
            throw new Exception('Error fetching access token: ' . $token['error']);
        }

        return $token;
    }

    // set access token and refresh if needed
    public function setAccessToken($token)
    {
        try {
            $this->client->setAccessToken($token);

            // Check if token is expired and refresh if needed
            if ($this->client->isAccessTokenExpired()) {
                if ($this->client->getRefreshToken()) {
                    $newToken = $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());

                    if (isset($newToken['error'])) {
                        throw new Exception('Error refreshing token: ' . $newToken['error']);
                    }

                    // IMPORTANT: Initialize calendar service after refresh
                    $this->service = new \Google_Service_Calendar($this->client);

                    return $newToken;
                } else {
                    throw new Exception('No refresh token available');
                }
            }

            // Initialize calendar service for non-expired token
            $this->service = new \Google_Service_Calendar($this->client);
            return null;
        } catch (Exception $e) {
            Log::error('Google Set Token Error', [
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }

    // create event in google calendar from this internal project
    // public function createEvent($work, $calendarId = 'primary')
    // {
    //     try {
    //         if (!$this->calendar) {
    //             throw new Exception('Calendar service not initialized. Call setAccessToken first.');
    //         }

    //         // Safe datetime build
    //         $startDateTime = Carbon::parse($work->work_date)->setTimeFromTimeString($work->time);
    //         $endDateTime = $startDateTime->copy()->addHour();

    //         $event = new Event([
    //             'summary' => $work->title,
    //             'description' => $work->description,
    //             'location' => $work->location,
    //             'start' => [
    //                 'dateTime' => $startDateTime->toRfc3339String(),
    //                 'timeZone' => config('app.timezone', 'UTC'),
    //             ],
    //             'end' => [
    //                 'dateTime' => $endDateTime->toRfc3339String(),
    //                 'timeZone' => config('app.timezone', 'UTC'),
    //             ],
    //         ]);

    //         $createdEvent = $this->calendar->events->insert($calendarId, $event);

    //         Log::info('Google Calendar event created', [
    //             'event_id' => $createdEvent->getId(),
    //             'work_id' => $work->id
    //         ]);

    //         return $createdEvent->getId();
    //     } catch (Exception $e) {
    //         Log::error('Google Calendar Create Error', [
    //             'error' => $e->getMessage(),
    //             'work_id' => $work->id
    //         ]);
    //         throw $e;
    //     }
    // }
    // create event in google calendar from this internal project
    public function createEvent($work, $calendarId = 'primary')
    {
        try {
            if (!$this->service) {
                throw new Exception('Calendar service not initialized. Call setAccessToken first.');
            }

            if ($work->is_all_day) {
                // All day event
                $event = new Event([
                    'summary' => $work->title,
                    'description' => $work->description,
                    'location' => $work->location,
                    'start' => [
                        'date' => Carbon::parse($work->start_datetime)->toDateString(),
                        'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                    ],
                    'end' => [
                        'date' => Carbon::parse($work->end_datetime)->toDateString(),
                        'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                    ],
                ]);
            } else {
                // Specific time event
                $event = new Event([
                    'summary' => $work->title,
                    'description' => $work->description,
                    'location' => $work->location,
                    'start' => [
                        'dateTime' => Carbon::parse($work->start_datetime)->toRfc3339String(),
                        'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                    ],
                    'end' => [
                        'dateTime' => Carbon::parse($work->end_datetime)->toRfc3339String(),
                        'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                    ],
                ]);
            }

            $createdEvent = $this->service->events->insert($calendarId, $event);

            Log::info('Google Calendar event created', [
                'event_id' => $createdEvent->getId(),
                'work_id' => $work->id
            ]);

            return $createdEvent->getId();
        } catch (Exception $e) {
            Log::error('Google Calendar Create Error', [
                'error' => $e->getMessage(),
                'work_id' => $work->id
            ]);
            throw $e;
        }
    }


    // update existing google calendar event from this internal project
    // public function updateEvent($work, $calendarId = 'primary')
    // {
    //     try {
    //         if (!$this->calendar) {
    //             throw new Exception('Calendar service not initialized. Call setAccessToken first.');
    //         }

    //         if (!$work->google_event_id) {
    //             throw new Exception('No Google event ID found for this work');
    //         }

    //         // Safe datetime build
    //         $startDateTime = Carbon::parse($work->work_date)->setTimeFromTimeString($work->time);
    //         $endDateTime = $startDateTime->copy()->addHour();

    //         // Get existing event
    //         $event = $this->calendar->events->get($calendarId, $work->google_event_id);

    //         // Update event properties
    //         $event->setSummary($work->title);
    //         $event->setDescription($work->description);
    //         $event->setLocation($work->location);

    //         $event->setStart(new EventDateTime([
    //             'dateTime' => $startDateTime->toRfc3339String(),
    //             'timeZone' => config('app.timezone', 'UTC'),
    //         ]));

    //         $event->setEnd(new EventDateTime([
    //             'dateTime' => $endDateTime->toRfc3339String(),
    //             'timeZone' => config('app.timezone', 'UTC'),
    //         ]));

    //         $updatedEvent = $this->calendar->events->update($calendarId, $work->google_event_id, $event);

    //         Log::info('Google Calendar event updated', [
    //             'event_id' => $updatedEvent->getId(),
    //             'work_id' => $work->id
    //         ]);

    //         return $updatedEvent->getId();
    //     } catch (Exception $e) {
    //         Log::error('Google Calendar Update Error', [
    //             'error' => $e->getMessage(),
    //             'work_id' => $work->id,
    //             'google_event_id' => $work->google_event_id
    //         ]);
    //         throw $e;
    //     }
    // }

    // update existing google calendar event from this internal project
    public function updateEvent($work, $calendarId = 'primary')
    {
        try {
            if (!$this->service) {
                throw new Exception('Calendar service not initialized. Call setAccessToken first.');
            }

            if (!$work->google_event_id) {
                throw new Exception('No Google event ID found for this work');
            }

            // Get existing event
            $event = $this->service->events->get($calendarId, $work->google_event_id);

            // Update event properties
            $event->setSummary($work->title);
            $event->setDescription($work->description);
            $event->setLocation($work->location);

            if ($work->is_all_day) {
                // All day event
                $event->setStart(new EventDateTime([
                    'date' => Carbon::parse($work->start_datetime)->toDateString(),
                    'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                ]));

                $event->setEnd(new EventDateTime([
                    'date' => Carbon::parse($work->end_datetime)->toDateString(),
                    'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                ]));
            } else {
                // Specific time event
                $event->setStart(new EventDateTime([
                    'dateTime' => Carbon::parse($work->start_datetime)->toRfc3339String(),
                    'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                ]));

                $event->setEnd(new EventDateTime([
                    'dateTime' => Carbon::parse($work->end_datetime)->toRfc3339String(),
                    'timeZone' => config('app.timezone', 'Asia/Dhaka'),
                ]));
            }

            $updatedEvent = $this->service->events->update($calendarId, $work->google_event_id, $event);

            Log::info('Google Calendar event updated', [
                'event_id' => $updatedEvent->getId(),
                'work_id' => $work->id
            ]);

            return $updatedEvent->getId();
        } catch (Exception $e) {
            Log::error('Google Calendar Update Error', [
                'error' => $e->getMessage(),
                'work_id' => $work->id,
                'google_event_id' => $work->google_event_id
            ]);
            throw $e;
        }
    }

    // delete event in google calendar from this internal project
    // public function deleteEvent($eventId, $calendarId = 'primary')
    // {
    //     try {
    //         if (!$this->calendar) {
    //             throw new Exception('Calendar service not initialized. Call setAccessToken first.');
    //         }

    //         $this->calendar->events->delete($calendarId, $eventId);

    //         Log::info('Google Calendar event deleted', [
    //             'event_id' => $eventId
    //         ]);

    //         return true;
    //     } catch (Exception $e) {
    //         Log::error('Google Calendar Delete Error', [
    //             'error' => $e->getMessage(),
    //             'event_id' => $eventId
    //         ]);
    //         throw $e;
    //     }
    // }


    // Fixed delete event method
    public function deleteEvent($eventId, $calendarId = 'primary')
    {
        try {
            if (!$this->service) {
                throw new Exception('Calendar service not initialized. Call setAccessToken first.');
            }

            if (empty($eventId)) {
                throw new Exception('Event ID is required');
            }

            $this->service->events->delete($calendarId, $eventId);

            Log::info('Google Calendar event deleted', [
                'event_id' => $eventId,
                'calendar_id' => $calendarId
            ]);

            return true;
        } catch (\Google_Service_Exception $e) {
            // Handle Google API specific errors
            $errors = json_decode($e->getMessage(), true);
            Log::error('Google Calendar Delete Error (API)', [
                'error' => $e->getMessage(),
                'event_id' => $eventId,
                'status_code' => $e->getCode(),
                'errors' => $errors
            ]);
            throw new Exception('Google Calendar API Error: ' . $e->getMessage());
        } catch (Exception $e) {
            Log::error('Google Calendar Delete Error', [
                'error' => $e->getMessage(),
                'event_id' => $eventId,
                'trace' => $e->getTraceAsString()
            ]);
            throw $e;
        }
    }

    // list events from google calendar
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
}
