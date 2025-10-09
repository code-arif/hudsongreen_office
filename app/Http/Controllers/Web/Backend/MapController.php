<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Team;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MapController extends Controller
{
    // init google map view with all teams and first team works
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
                'time',
                'is_completed',
                'is_rescheduled'
            )
            ->get()
            : collect(); // empty if no team exists

        return view('backend.layouts.map.global_map', compact('teams', 'works', 'firstTeam'));
    }

    // filter works by team id and return as json
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
                'time',
                'is_completed',
                'is_rescheduled'
            )
            ->get();

        return response()->json($works);
    }

    // search teams by name and return as json
    public function searchTeams(Request $request)
    {
        $query = $request->query('query');
        $teams = Team::where('name', 'like', "%{$query}%")->get(['id', 'name']);
        return response()->json($teams);
    }
}
