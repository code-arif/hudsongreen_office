<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Display the dashboard view.
     */
    public function index()
    {
        $user = auth()->user();
        $totalUsers = User::count();
        return view('backend.layouts.dashboard', compact(
            'totalUsers',
        ));
    }
}
