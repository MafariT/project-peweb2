<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Jadwal;

class ViewServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Only pass jadwals to specific views
        View::composer([
            'welcome',
            'jadwal.*',
            'dashboard'
        ], function ($view) {
            $jadwals = Auth::check()
                ? Jadwal::where('user_id', Auth::id())->get()
                : collect();

            $view->with('jadwals', $jadwals);
        });
    }
}

