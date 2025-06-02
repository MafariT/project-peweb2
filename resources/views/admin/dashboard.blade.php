<x-sidebar-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4">
        <div class="mb-6">
            <h3 class="text-lg font-medium text-gray-900">
                Welcome back, {{ Auth::user()->name }}!
            </h3>
            <p class="text-sm text-gray-600">
                Here’s what’s happening today.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm text-gray-500">Total Users</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalUsers }}</div>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm text-gray-500">Total Admins</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $totalAdmins }}</div>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm text-gray-500">Recent Signups (7 days)</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $recentSignups }}</div>
            </div>
            <div class="bg-white shadow rounded-lg p-4">
                <div class="text-sm text-gray-500">Active Sessions</div>
                <div class="mt-1 text-2xl font-semibold text-gray-900">{{ $activeSessions }}</div>
            </div>
        </div>

        <div class="mt-8">
            <h4 class="text-md font-semibold text-gray-800 mb-2">Recent Signups by Role</h4>
            <ul class="bg-white shadow rounded-lg divide-y divide-gray-200 mb-8">
                @foreach ($recentSignupsByRole as $roleStat)
                    <li class="p-4 text-sm text-gray-700">
                        Role <strong>{{ $roleStat->role }}</strong>: {{ $roleStat->count }} new users
                    </li>
                @endforeach
            </ul>

            <h4 class="text-md font-semibold text-gray-800 mb-2">Recent User Activity</h4>
            <ul class="bg-white shadow rounded-lg divide-y divide-gray-200">
                @forelse ($recentActivities as $activity)
                    <li class="p-4 text-sm text-gray-700">
                        {{ $activity->description }}
                        <span class="text-gray-400 text-xs">({{ $activity->created_at->diffForHumans() }})</span>
                    </li>
                @empty
                    <li class="p-4 text-sm text-gray-700">No recent activity found.</li>
                @endforelse
            </ul>
        </div>
    </div>
</x-sidebar-admin-layout>
