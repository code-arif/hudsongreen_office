<?php

namespace App\Http\Controllers\Web;

use Exception;
use App\Models\Team;
use App\Models\TeamLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TrackingController extends Controller
{
    /**
     * Show tracking dashboard
     */
    public function index()
    {
        $teams = Team::withCount('users')->get();

        return view('backend.layouts.map.tracking', compact('teams'));
    }

    /**
     * Get all locations for map (AJAX)
     */
    public function getLocations(Request $request)
    {
        try {
            $teamId = $request->get('team_id');

            $query = TeamLocation::select(
                'team_locations.*',
                'teams.name as team_name',
                'users.name as user_name',
                'users.avatar as user_avatar',
                'team_users.is_leader'
            )
                ->join('teams', 'teams.id', '=', 'team_locations.team_id')
                ->join('users', 'users.id', '=', 'team_locations.user_id')
                ->join('team_users', function ($join) {
                    $join->on('team_users.team_id', '=', 'team_locations.team_id')
                        ->on('team_users.user_id', '=', 'team_locations.user_id');
                })
                ->whereIn('team_locations.id', function ($subQuery) {
                    $subQuery->select(DB::raw('MAX(id)'))
                        ->from('team_locations')
                        ->where('tracked_at', '>=', now()->subMinutes(10))
                        ->groupBy('team_id', 'user_id');
                })
                ->where('team_users.is_leader', true);

            // Filter by specific team if requested
            if ($teamId) {
                $query->where('team_locations.team_id', $teamId);
            }

            $locations = $query->orderBy('team_locations.tracked_at', 'desc')->get();

            return response()->json([
                'success' => true,
                'data' => $locations,
                'count' => $locations->count(),
                'timestamp' => now()->toIso8601String()
            ]);
        } catch (Exception $e) {
            Log::error('Failed to fetch locations', ['error' => $e->getMessage()]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch locations',
                'error' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
        }
    }

    /**
     * Get team location route/path with work polylines
     */
    public function getTeamRoute(Request $request, $teamId)
    {
        try {
            $hours = $request->get('hours', 24);

            // Get location path
            $locations = TeamLocation::select('id', 'latitude', 'longitude', 'tracked_at', 'speed')
                ->where('team_id', $teamId)
                ->where('tracked_at', '>=', now()->subHours($hours))
                ->orderBy('tracked_at', 'asc')
                ->get();

            // Get assigned works with status
            $works = Work::select(
                'works.*',
                'work_tracking.status as tracking_status',
                'work_tracking.started_at',
                'work_tracking.completed_at'
            )
                ->leftJoin('work_tracking', function ($join) use ($teamId) {
                    $join->on('work_tracking.work_id', '=', 'works.id')
                        ->where('work_tracking.team_id', '=', $teamId);
                })
                ->where('works.team_id', $teamId)
                ->whereNotNull('works.latitude')
                ->whereNotNull('works.longitude')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'route' => $locations,
                    'works' => $works,
                    'total_points' => $locations->count()
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch team route',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all active teams with stats
     */
    public function getActiveTeams()
    {
        try {
            $teams = Team::select(
                'teams.id',
                'teams.name',
                DB::raw('COUNT(DISTINCT tl.user_id) as active_members'),
                DB::raw('MAX(tl.tracked_at) as last_update'),
                DB::raw('COUNT(DISTINCT w.id) as total_works'),
                DB::raw('SUM(CASE WHEN w.is_completed = 1 THEN 1 ELSE 0 END) as completed_works')
            )
                ->leftJoin('team_locations as tl', function ($join) {
                    $join->on('tl.team_id', '=', 'teams.id')
                        ->where('tl.tracked_at', '>=', now()->subMinutes(10));
                })
                ->leftJoin('works as w', 'w.team_id', '=', 'teams.id')
                ->groupBy('teams.id', 'teams.name')
                ->having('active_members', '>', 0)
                ->get();

            return response()->json([
                'success' => true,
                'data' => $teams
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch teams',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get team history with detailed analytics
     */
    public function getTeamHistory($teamId)
    {
        try {
            $hours = request()->get('hours', 24);

            $history = TeamLocation::select(
                'team_locations.*',
                'users.name as user_name'
            )
                ->join('users', 'users.id', '=', 'team_locations.user_id')
                ->where('team_locations.team_id', $teamId)
                ->where('team_locations.tracked_at', '>=', now()->subHours($hours))
                ->orderBy('team_locations.tracked_at', 'asc')
                ->get();

            // Calculate analytics
            $analytics = [
                'total_distance' => $this->calculateTotalDistance($history),
                'average_speed' => $history->avg('speed'),
                'max_speed' => $history->max('speed'),
                'duration' => $this->calculateDuration($history),
                'data_points' => $history->count()
            ];

            return response()->json([
                'success' => true,
                'data' => $history,
                'analytics' => $analytics
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch team history',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Calculate total distance
     */
    private function calculateTotalDistance($locations)
    {
        if ($locations->count() < 2) {
            return 0;
        }

        $totalDistance = 0;
        $previousLocation = $locations->first();

        foreach ($locations->skip(1) as $location) {
            $distance = $this->haversineDistance(
                $previousLocation->latitude,
                $previousLocation->longitude,
                $location->latitude,
                $location->longitude
            );

            $totalDistance += $distance;
            $previousLocation = $location;
        }

        return round($totalDistance, 2); // km
    }

    /**
     * Haversine formula for distance calculation
     */
    private function haversineDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371; // km

        $lat1 = deg2rad($lat1);
        $lon1 = deg2rad($lon1);
        $lat2 = deg2rad($lat2);
        $lon2 = deg2rad($lon2);

        $latDiff = $lat2 - $lat1;
        $lonDiff = $lon2 - $lon1;

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos($lat1) * cos($lat2) *
            sin($lonDiff / 2) * sin($lonDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return $earthRadius * $c;
    }

    /**
     * Calculate tracking duration
     */
    private function calculateDuration($locations)
    {
        if ($locations->count() < 2) {
            return 0;
        }

        $first = $locations->first()->tracked_at;
        $last = $locations->last()->tracked_at;

        return round($first->diffInMinutes($last), 2);
    }
}
