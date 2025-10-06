<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Team;
use App\Models\Work;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    public function globalMap()
    {
        $teams = Team::all();
        $firstTeam = $teams->first();

        $works = $firstTeam
            ? Work::where('team_id', $firstTeam->id)
            ->select(
                'id',
                'title',
                'description',
                'location',
                'latitude',
                'longitude',
                'work_date',
                'start_time',
                'end_time',
                'is_completed',
                'is_rescheduled'
            )
            ->get()
            : collect(); // empty if no team exists

        return view('backend.layouts.map.global_map', compact('teams', 'works', 'firstTeam'));
    }

    public function filterWorksByTeam($teamId)
    {
        $works = Work::where('team_id', $teamId)
            ->select(
                'id',
                'title',
                'description',
                'location',
                'latitude',
                'longitude',
                'work_date',
                'start_time',
                'end_time',
                'is_completed',
                'is_rescheduled'
            )
            ->get();

        return response()->json($works);
    }
}
