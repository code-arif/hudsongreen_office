<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Team;
use App\Models\User;
use App\Models\Work;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $user = auth()->user();

        // User Statistics
        $totalEmployees = User::where('role', 'employee')->count();
        $totalAdmins = User::where('role', 'admin')->count();

        // Work Statistics
        $totalWorks = Work::count();
        $completedWorks = Work::where('is_completed', true)->count();
        $pendingWorks = Work::where('is_completed', false)
            ->where('is_rescheduled', false)
            ->count();
        $rescheduledWorks = Work::where('is_rescheduled', true)->count();

        // Today's Work Statistics
        $todaysWorks = Work::whereDate('work_date', today())->count();
        $todaysCompletedWorks = Work::whereDate('work_date', today())
            ->where('is_completed', true)
            ->count();

        // Team Statistics
        $totalTeams = Team::count();
        $teamsWithWorks = Team::whereHas('works')->count();

        // Work Status Statistics
        $worksByStatus = Work::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Recent Works (last 7 days)
        $recentWorks = Work::where('created_at', '>=', now()->subDays(7))->count();

        // Works This Month
        $thisMonthWorks = Work::whereMonth('work_date', now()->month)
            ->whereYear('work_date', now()->year)
            ->count();

        $thisMonthCompletedWorks = Work::whereMonth('work_date', now()->month)
            ->whereYear('work_date', now()->year)
            ->where('is_completed', true)
            ->count();

        return view('backend.layouts.dashboard', compact(
            'totalEmployees',
            'totalAdmins',
            'totalWorks',
            'completedWorks',
            'pendingWorks',
            'rescheduledWorks',
            'todaysWorks',
            'todaysCompletedWorks',
            'totalTeams',
            'teamsWithWorks',
            'worksByStatus',
            'recentWorks',
            'thisMonthWorks',
            'thisMonthCompletedWorks',
        ));
    }

    /**
     * Dashboard chart status
     */
    public function getDashboardData()
    {
        // 1. Team Count
        $totalTeams = DB::table('teams')->count();

        // 2. User Count (employees only, assuming 'admin' not counted as worker)
        $totalEmployees = DB::table('users')->where('role', 'employee')->count();

        // 3. Work Status Distribution
        $workStatuses = DB::table('works')
            ->selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->get()
            ->mapWithKeys(fn($item) => [$item->status => $item->count]);

        // 4. Completed vs Incomplete Works
        $workCompletion = [
            'completed' => DB::table('works')->where('is_completed', true)->count(),
            'incomplete' => DB::table('works')->where('is_completed', false)->count(),
        ];

        // 5. New Works (Last 30 Days)
        $newWorks = DB::table('works')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(fn($item) => [$item->date => $item->count]);

        // 6. Reschedule Requests (Last 30 Days) – by status
        $rescheduleRequests = DB::table('reschedule_requests')
            ->selectRaw('status, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('status')
            ->get()
            ->mapWithKeys(fn($item) => [$item->status => $item->count]);

        // 7. Top Teams by Work Assigned (last 30 days)
        $topTeams = DB::table('works')
            ->join('teams', 'works.team_id', '=', 'teams.id')
            ->selectRaw('teams.name, COUNT(works.id) as work_count')
            ->where('works.created_at', '>=', now()->subDays(30))
            ->whereNotNull('works.team_id')
            ->groupBy('teams.id', 'teams.name')
            ->orderByDesc('work_count')
            ->limit(5)
            ->get()
            ->mapWithKeys(fn($item) => [$item->name => $item->work_count]);

        // 8. Daily Work Completion (Last 30 Days)
        $dailyCompletedWorks = DB::table('works')
            ->selectRaw('DATE(work_date) as date, COUNT(*) as count')
            ->where('is_completed', true)
            ->where('work_date', '>=', now()->subDays(30)->toDateString())
            ->whereNotNull('work_date')
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->mapWithKeys(fn($item) => [$item->date => $item->count]);

        return response()->json([
            'team_stats' => [
                'total_teams' => $totalTeams,
                'total_employees' => $totalEmployees,
            ],
            'work_status_distribution' => [
                0 => $workStatuses[0] ?? 0,
                1 => $workStatuses[1] ?? 0,
                2 => $workStatuses[2] ?? 0,
            ],
            'work_completion' => $workCompletion,
            'new_works' => $newWorks,
            'reschedule_requests' => [
                'pending' => $rescheduleRequests[1] ?? 0,
                'approved' => $rescheduleRequests[2] ?? 0,
                'rejected' => $rescheduleRequests[3] ?? 0,
            ],
            'top_teams_by_work' => $topTeams,
            'daily_completed_works' => $dailyCompletedWorks,
        ]);
    }
}
