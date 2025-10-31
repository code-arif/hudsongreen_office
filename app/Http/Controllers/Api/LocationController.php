<?php

namespace App\Http\Controllers\Api;

use App\Events\LocationUpdated;
use App\Http\Controllers\Controller;
use App\Models\TeamLocation;
use App\Models\Work;
use App\Models\WorkTracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    /**
     * Batch location update with real-time broadcasting
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'team_id' => 'required|exists:teams,id',
            'device_id' => 'nullable|string',
            'locations' => 'required|array|min:1|max:50', // Limit batch size
            'locations.*.latitude' => 'required|numeric|between:-90,90',
            'locations.*.longitude' => 'required|numeric|between:-180,180',
            'locations.*.accuracy' => 'nullable|numeric|min:0|max:1000',
            'locations.*.speeds' => 'nullable|numeric|min:0',
            'locations.*.bearing' => 'nullable|numeric|between:0,360',
            'locations.*.altitude' => 'nullable|numeric',
            'locations.*.battery_level' => 'nullable|string',
            'locations.*.is_mock_location' => 'nullable|boolean',
            'locations.*.activity_type' => 'nullable|string',
            'locations.*.network_type' => 'nullable|string',
            'locations.*.tracked_at' => 'required|date'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Verify team membership
            $teamUser = DB::table('team_users')
                ->where('team_id', $request->team_id)
                ->where('user_id', auth()->id())
                ->first();

            if (!$teamUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not a member of this team'
                ], 403);
            }

            // Check if tracking is enabled
            if (!$teamUser->is_tracking_active) {
                return response()->json([
                    'success' => false,
                    'message' => 'Location tracking is disabled'
                ], 403);
            }

            $savedLocations = [];
            $broadcastCount = 0;

            DB::beginTransaction();

            foreach ($request->locations as $index => $locationData) {
                // Skip mock locations
                if (isset($locationData['is_mock_location']) && $locationData['is_mock_location']) {
                    continue;
                }

                // Skip low accuracy readings
                if (isset($locationData['accuracy']) && $locationData['accuracy'] > 100) {
                    continue;
                }

                // Create location record
                $location = TeamLocation::create([
                    'team_id' => $request->team_id,
                    'user_id' => auth()->id(),
                    'device_id' => $request->device_id,
                    'latitude' => $locationData['latitude'],
                    'longitude' => $locationData['longitude'],
                    'accuracy' => $locationData['accuracy'] ?? null,
                    'speeds' => $locationData['speeds'] ?? null,
                    'bearing' => $locationData['bearing'] ?? null,
                    'altitude' => $locationData['altitude'] ?? null,
                    'battery_level' => $locationData['battery_level'] ?? null,
                    'is_mock_location' => false,
                    'activity_type' => $locationData['activity_type'] ?? null,
                    'network_type' => $locationData['network_type'] ?? null,
                    'status' => 'active',
                    'tracked_at' => $locationData['tracked_at']
                ]);

                $savedLocations[] = $location;

                // Broadcast only the latest location to reduce load
                if ($index === count($request->locations) - 1) {
                    broadcast(new LocationUpdated($location))->toOthers();
                    $broadcastCount++;
                }

                // Check geofence for work assignments
                $this->checkWorkGeofence(
                    $request->team_id,
                    $locationData['latitude'],
                    $locationData['longitude']
                );
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Locations updated successfully',
                'data' => [
                    'saved_count' => count($savedLocations),
                    'broadcast_count' => $broadcastCount,
                    'tracking_status' => 'active',
                    'next_update_interval' => 10 // seconds
                ]
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Location update failed', [
                'user_id' => auth()->id(),
                'team_id' => $request->team_id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to update location',
                'error' => config('app.debug') ? $e->getMessage() : 'Server error'
            ], 500);
        }
    }

    /**
     * Check work geofence with entry/exit detection
     */
    private function checkWorkGeofence($teamId, $latitude, $longitude)
    {
        $activeWorks = Work::where('team_id', $teamId)
            ->where('is_completed', false)
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->get();

        foreach ($activeWorks as $work) {
            $distance = $this->calculateDistance(
                $latitude,
                $longitude,
                $work->latitude,
                $work->longitude
            );

            $isInside = $distance <= $work->geofence_radius;

            $tracking = WorkTracking::firstOrCreate(
                [
                    'work_id' => $work->id,
                    'team_id' => $teamId
                ],
                [
                    'status' => 'pending'
                ]
            );

            // Geofence entry detection
            if ($isInside && $tracking->status === 'pending') {
                $tracking->update([
                    'started_at' => now(),
                    'status' => 'in_progress'
                ]);

                Log::info("Team entered work geofence", [
                    'team_id' => $teamId,
                    'work_id' => $work->id,
                    'distance' => $distance
                ]);
            }
        }
    }

    /**
     * Haversine distance calculation
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        $earthRadius = 6371000; // meters
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
     * Get current locations (last 5 minutes)
     */
    public function getCurrentLocations()
    {
        try {
            $locations = TeamLocation::select(
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
                ->whereIn('team_locations.id', function ($query) {
                    $query->select(DB::raw('MAX(id)'))
                        ->from('team_locations')
                        ->where('tracked_at', '>=', now()->subMinutes(5))
                        ->where('status', 'active')
                        ->groupBy('team_id', 'user_id');
                })
                ->where('team_users.is_leader', true)
                ->orderBy('team_locations.tracked_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $locations,
                'count' => $locations->count(),
                'timestamp' => now()->toIso8601String()
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch locations',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get team location history
     */
    public function getTeamHistory($teamId, Request $request)
    {
        $hours = $request->get('hours', 24);

        try {
            $locations = TeamLocation::with('user:id,name,avatar')
                ->where('team_id', $teamId)
                ->where('tracked_at', '>=', now()->subHours($hours))
                ->orderBy('tracked_at', 'asc')
                ->get();

            $works = Work::where('team_id', $teamId)
                ->whereNotNull('latitude')
                ->whereNotNull('longitude')
                ->with('tracking')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'locations' => $locations,
                    'works' => $works,
                    'total_distance' => $this->calculateTotalDistance($locations),
                    'duration_minutes' => $this->calculateDuration($locations)
                ]
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch team history',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Total deistance calculation
     */
    private function calculateTotalDistance($locations)
    {
        if ($locations->count() < 2) return 0;

        $totalDistance = 0;
        $previousLocation = $locations->first();

        foreach ($locations->skip(1) as $location) {
            $distance = $this->calculateDistance(
                $previousLocation->latitude,
                $previousLocation->longitude,
                $location->latitude,
                $location->longitude
            );
            $totalDistance += $distance;
            $previousLocation = $location;
        }

        return round($totalDistance / 1000, 2); // km
    }

    /**
     * Calculation duration
     */
    private function calculateDuration($locations)
    {
        if ($locations->count() < 2) return 0;

        $first = $locations->first()->tracked_at;
        $last = $locations->last()->tracked_at;

        return $first->diffInMinutes($last);
    }
}
