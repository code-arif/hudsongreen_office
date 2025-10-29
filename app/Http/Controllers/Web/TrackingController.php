<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\TeamLocation;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class TrackingController extends Controller
{
    /**
     * Get all teams' latest locations (for map view)
     */
    public function getLocations(Request $request)
    {
        $teamId = $request->query('team_id');

        // Try to get from cache first
        $cacheKey = $teamId ? "admin_locations_team_{$teamId}" : "admin_locations_all";

        $locations = Cache::remember($cacheKey, 30, function () use ($teamId) {
            $query = TeamLocation::with(['team:id,name', 'user:id,name,avatar'])
                ->select('team_locations.*')
                ->join(
                    DB::raw('(SELECT team_id, MAX(tracked_at) as max_tracked
                             FROM team_locations
                             GROUP BY team_id) as latest'),
                    function ($join) {
                        $join->on('team_locations.team_id', '=', 'latest.team_id')
                            ->on('team_locations.tracked_at', '=', 'latest.max_tracked');
                    }
                );

            if ($teamId) {
                $query->where('team_locations.team_id', $teamId);
            }

            // Only show locations from last 5 minutes
            $query->where('tracked_at', '>=', now()->subMinutes(5));

            return $query->get();
        });

        // Get active works
        $works = $this->getActiveWorks($teamId);

        return response()->json([
            'success' => true,
            'data' => [
                'locations' => $locations,
                'works' => $works,
                'last_updated' => now()->toIso8601String(),
            ]
        ]);
    }

    /**
     * Get all teams with their current status
     */
    public function getTeams()
    {
        $teams = Team::withCount('users')
            ->get()
            ->map(function ($team) {
                $latestLocation = Cache::get("team_location:{$team->id}");

                return [
                    'id' => $team->id,
                    'name' => $team->name,
                    'members_count' => $team->users_count,
                    'is_active' => $latestLocation !== null,
                    'last_seen' => $latestLocation['tracked_at'] ?? null,
                    'current_leader' => $latestLocation['user_name'] ?? null,
                ];
            });

        return response()->json([
            'success' => true,
            'data' => $teams
        ]);
    }

    /**
     * Get location history for a specific team
     */
    public function getHistory($teamId, Request $request)
    {
        $date = $request->query('date', now()->toDateString());

        $history = TeamLocation::with('user:id,name')
            ->where('team_id', $teamId)
            ->whereDate('tracked_at', $date)
            ->orderBy('tracked_at', 'asc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => [
                'team_id' => $teamId,
                'date' => $date,
                'locations' => $history,
                'total_points' => $history->count(),
            ]
        ]);
    }

    /**
     * Get active works for mapping
     */
    private function getActiveWorks($teamId = null)
    {
        $query = Work::with('team:id,name')
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->whereDate('start_datetime', '<=', now())
            ->whereDate('end_datetime', '>=', now())
            ->where('is_completed', false);

        if ($teamId) {
            $query->where('team_id', $teamId);
        }

        return $query->get();
    }
}
