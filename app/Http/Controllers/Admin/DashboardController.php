<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Jadwal;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        
        $totalJadwalKuliah = Jadwal::count();

        $recentSignups = User::where('created_at', '>=', now()->subDays(7))->count();

        // Simulate recent activity by users updated in last 7 days
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

        $recentNewUsers = User::withCount('jadwals')
            ->where('created_at', '>=', now()->subDays(7))
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get(['id', 'name', 'email', 'created_at']);

        return view('admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalJadwalKuliah' => $totalJadwalKuliah,
            'recentSignups' => $recentSignups,
            'recentActivities' => $recentActivities,
            'recentNewUsers' => $recentNewUsers,
        ]);
    }
}
