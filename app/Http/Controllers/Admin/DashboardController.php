<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalAdmins = User::where('role', 'admin')->count();

        $recentSignups = User::where('created_at', '>=', now()->subDays(7))->count();

        // Recent signups by role (last 7 days) grouped
        $recentSignupsByRole = User::select('role', DB::raw('count(*) as count'))
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('role')
            ->get();

        // For recent activity, since no logs are available,
        // we use users updated in last 7 days (simulate activity)
        $recentActivities = User::where('updated_at', '>=', now()->subDays(7))
            ->orderBy('updated_at', 'desc')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return (object)[
                    'description' => "{$user->name} ({$user->role}) updated profile",
                    'created_at' => $user->updated_at,
                ];
            });

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalAdmins' => $totalAdmins,
            'recentSignups' => $recentSignups,
            'recentSignupsByRole' => $recentSignupsByRole,
            'activeSessions' => 0, // no real data available yet
            'recentActivities' => $recentActivities,
        ]);
    }
}
