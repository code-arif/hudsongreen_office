<?php

namespace App\Models;

use Illuminate\Support\Carbon;
use Spatie\GoogleCalendar\Event;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $guarded = [];

    // fillable fields
    protected $fillable = [
        'title',
        'description',
        'location',
        'latitude',
        'longitude',
        'time',
        'work_date',
        'is_completed',
        'is_rescheduled',
        'note',
        'status',
        'team_id',
        'category_id',
        'google_event_id',
    ];

    // casting fields
    protected $casts = [
        'work_date' => 'date',
        'is_completed' => 'boolean',
        'is_rescheduled' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
    ];

    // relation with team table
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    // relation with category table
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // relation with work_images table
    public function images()
    {
        return $this->hasMany(WorkImage::class, 'work_id');
    }

    // relation with reschedule_requests table
    public function rescheduleRequests()
    {
        return $this->hasMany(RescheduleRequest::class, 'work_id');
    }

    // relation with reschedule_requests table
    public function request()
    {
        return $this->hasOne(RescheduleRequest::class, 'work_id');
    }

    public function getStartDateTimeAttribute()
    {
        return $this->work_date->format('Y-m-d') . ' ' . $this->time->format('H:i:s');
    }

    public function getEndDateTimeAttribute()
    {
        $endTime = Carbon::parse($this->time)->addHour();
        return $this->work_date->format('Y-m-d') . ' ' . $endTime->format('H:i:s');
    }

    public function syncToGoogleCalendar()
    {
        if (!$this->google_event_id) {
            $event = Event::create([
                'name' => $this->title,
                'description' => $this->description . "\n\nLocation: " . $this->location . "\nTeam: " . ($this->team?->name ?? 'N/A'),
                'startDateTime' => $this->start_date_time,
                'endDateTime' => $this->end_date_time,
            ]);

            $this->update(['google_event_id' => $event->id]);
            return $event;
        }
    }

    public function updateGoogleCalendar()
    {
        if ($this->google_event_id) {
            $event = Event::find($this->google_event_id);
            if ($event) {
                $event
                    ->name($this->title)
                    ->description($this->description . "\n\nLocation: " . $this->location . "\nTeam: " . ($this->team?->name ?? 'N/A'))
                    ->startDateTime($this->start_date_time)
                    ->endDateTime($this->end_date_time)
                    ->save();
            }
        }
    }

    public function deleteFromGoogleCalendar()
    {
        if ($this->google_event_id) {
            $event = \Spatie\GoogleCalendar\Event::find($this->google_event_id);
            if ($event) {
                $event->delete();
            }
            $this->update(['google_event_id' => null]);
        }
    }
}
