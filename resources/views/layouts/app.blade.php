<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=inter:400,600&display=swap" />

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-[#0f172a] text-white p-6 space-y-4">
            <div class="flex flex-col items-center justify-center mb-6">
                <x-application-logo class="w-[150px] h-auto fill-current text-white" />
                <div class="mt-2 text-xl font-bold">PlanMyClass</div>
            </div>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="space-y-2">
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-2 bg-[#1e293b] hover:bg-[#334155] rounded text-sm font-medium focus:outline-none"
                >
                    <span class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 10a4 4 0 100-8 4 4 0 000 8zM3 18a7 7 0 0114 0H3z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                    </span>
                    <svg :class="{'rotate-180': open}" class="w-4 h-4 transition-transform" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition class="ml-6 space-y-2 text-sm">
                    <a href="{{ route('profile.edit') }}" class="block hover:text-gray-300">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-gray-300">Logout</button>
                    </form>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2 mt-6">
                <a href="{{ route('dashboard') }}"
                class="flex items-center space-x-2 px-4 py-2 rounded
                        {{ request()->routeIs('dashboard') ? 'bg-white text-black' : 'hover:opacity-80 text-white' }}">
                    <span>🏠</span><span>Dashboard</span>
                </a>

                <a href="{{ route('jadwal.index') }}"
                class="flex items-center space-x-2 px-4 py-2 rounded
                        {{ request()->routeIs('jadwal.index') ? 'bg-white text-black' : 'hover:opacity-80 text-white' }}">
                    <span>📅</span><span>Jadwal Kuliah</span>
                </a>

                <a href="{{ route('jadwal.create') }}"
                class="flex items-center space-x-2 px-4 py-2 rounded
                        {{ request()->routeIs('jadwal.create') ? 'bg-white text-black' : 'hover:opacity-80 text-white' }}">
                    <span>➕</span><span>Tambah Jadwal</span>
                </a>
            </nav>
        </aside>


        <!-- Main content -->
        <div class="flex-1 flex flex-col">
            <!-- Top bar / header -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-6">
                    {{ $header ?? '' }}
                </div>
            </header>

            <!-- Page content -->
            <main class="flex-1">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
