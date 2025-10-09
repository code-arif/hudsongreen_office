<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Team;
use App\Models\Work;
use Illuminate\Http\Request;
use Spatie\GoogleCalendar\Event;
use Illuminate\Support\Facades\Auth;

class GoogleCalendarController extends Controller
{
    public function index(Request $request)
    {
        $teamId = $request->get('team_id');
        $status = $request->get('status');
        $dateRange = $request->get('date_range', 'month');

        $query = Work::with(['team', 'category'])
            ->when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->when($status, fn($q) => $q->where('is_completed', $status === 'completed'))
            ->when($dateRange === 'week', fn($q) => $q->whereBetween('work_date', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ]))
            ->when($dateRange === 'month', fn($q) => $q->whereMonth('work_date', Carbon::now()->month))
            ->orderBy('work_date')
            ->orderBy('time');

        $works = $query->get();
        $teams = Team::all();

        return view('backend.layouts.calendar.index', compact('works', 'teams', 'teamId', 'status', 'dateRange'));
    }

    public function create()
    {
        $teams = Team::all();
        return view('backend.layouts.calendar.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'time' => 'required',
            'work_date' => 'required|date',
            'team_id' => 'nullable|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'is_completed' => 'boolean',
            'is_rescheduled' => 'boolean',
        ]);

        $work = Work::create($validated);

        // Sync to Google Calendar
        if (Auth::user()->role === 'admin') {
            $work->syncToGoogleCalendar();
        }

        return redirect()->route('calendar.index')->with('success', 'Work schedule created successfully!');
    }

    public function edit(Work $work)
    {
        $teams = Team::all();
        return view('backend.layouts.calendar.edit', compact('work', 'teams'));
    }

    public function update(Request $request, Work $work)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'time' => 'required',
            'work_date' => 'required|date',
            'team_id' => 'nullable|exists:teams,id',
            'category_id' => 'nullable|exists:categories,id',
            'is_completed' => 'boolean',
            'is_rescheduled' => 'boolean',
            'note' => 'nullable|string',
        ]);

        $work->update($validated);

        // Update Google Calendar
        if (Auth::user()->role === 'admin' && $work->google_event_id) {
            $work->updateGoogleCalendar();
        }

        return redirect()->route('calendar.index')->with('success', 'Work schedule updated successfully!');
    }

    public function destroy(Work $work)
    {
        // Delete from Google Calendar first
        if (Auth::user()->role === 'admin') {
            $work->deleteFromGoogleCalendar();
        }

        $work->delete();

        return redirect()->route('calendar.index')->with('success', 'Work schedule deleted successfully!');
    }

    public function toggleStatus(Request $request, Work $work)
    {
        $work->update(['is_completed' => !$work->is_completed]);

        // Update Google Calendar event status
        if ($work->google_event_id && Auth::user()->role === 'admin') {
            $event = Event::find($work->google_event_id);
            if ($event) {
                $status = $work->is_completed ? 'confirmed' : 'needsAction';
                $event->status($status)->save();
            }
        }

        return response()->json(['success' => true, 'completed' => $work->is_completed]);
    }

    public function getEvents(Request $request)
    {
        $start = $request->get('start');
        $end = $request->get('end');
        $teamId = $request->get('team_id');

        $query = Work::whereBetween('work_date', [Carbon::parse($start), Carbon::parse($end)])
            ->when($teamId, fn($q) => $q->where('team_id', $teamId))
            ->get();

        $events = $query->map(function ($work) {
            $color = $work->is_completed ? '#28a745' : ($work->is_rescheduled ? '#ffc107' : '#dc3545');

            return [
                'id' => $work->id,
                'title' => $work->title . ' (' . ($work->team?->name ?? 'No Team') . ')',
                'start' => $work->start_date_time,
                'end' => $work->end_date_time,
                'description' => $work->description,
                'location' => $work->location,
                'color' => $color,
                'completed' => $work->is_completed,
                'rescheduled' => $work->is_rescheduled,
                'url' => route('works.edit', $work->id),
            ];
        });

        return response()->json($events);
    }
}
