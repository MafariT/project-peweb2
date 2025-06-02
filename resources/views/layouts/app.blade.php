<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link
        rel="stylesheet"
        href="https://fonts.bunny.net/css?family=inter:400,600&display=swap"
    />

    <!-- Styles and Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js CDN -->
    <script
        defer
        src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"
    ></script>

    <style>
      /* Prevent horizontal scrollbar during sidebar animation */
      body {
        overflow-x: hidden;
      }
    </style>
</head>
<body
    class="font-sans antialiased bg-gray-100"
    x-data="{ sidebarOpen: window.innerWidth >= 768 }"
    x-init="
      window.addEventListener('resize', () => {
        if (window.innerWidth >= 768) sidebarOpen = true;
      });
    "
>

    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <aside
            x-cloak
            x-show="sidebarOpen"
            x-transition:enter="transition duration-300 ease-out"
            x-transition:enter-start="opacity-0 -translate-x-20"
            x-transition:enter-end="opacity-100 translate-x-0"
            x-transition:leave="transition duration-300 ease-in"
            x-transition:leave-start="opacity-100 translate-x-0"
            x-transition:leave-end="opacity-0 -translate-x-20"
            class="fixed inset-y-0 left-0 w-64 bg-[#0f172a] text-white p-6 space-y-4 z-30"
        >
            <!-- Close button top right inside sidebar -->
            <button
                @click="sidebarOpen = false"
                aria-label="Close sidebar"
                class="absolute top-4 right-4 text-white hover:text-gray-300 focus:outline-none"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    viewBox="0 0 24 24"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <line x1="18" y1="6" x2="6" y2="18" />
                    <line x1="6" y1="6" x2="18" y2="18" />
                </svg>
            </button>

            <div class="flex flex-col items-center justify-center mb-6">
                <x-application-logo
                    class="w-[150px] h-auto fill-current text-white"
                />
            </div>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="space-y-2">
                <button
                    @click="open = !open"
                    class="w-full flex items-center justify-between px-4 py-2 bg-[#1e293b] hover:bg-[#334155] rounded text-sm font-medium focus:outline-none"
                >
                    <span class="flex items-center space-x-2">
                        <svg
                            class="w-5 h-5 text-white"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M10 10a4 4 0 100-8 4 4 0 000 8zM3 18a7 7 0 0114 0H3z"
                                clip-rule="evenodd"
                            />
                        </svg>
                        <span>{{ Auth::user()->name }}</span>
                    </span>
                    <svg
                        :class="{ 'rotate-180': open }"
                        class="w-4 h-4 transition-transform"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div x-show="open" x-transition class="ml-6 space-y-2 text-sm">
                    <a href="{{ route('profile.edit') }}" class="block hover:text-gray-300"
                        >Profile</a
                    >
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="hover:text-gray-300">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="space-y-2 mt-6">
                <a
                    href="{{ route('dashboard') }}"
                    class="flex items-center space-x-2 px-4 py-2 rounded
                        {{ request()->routeIs('dashboard') ? 'bg-white text-black' : 'hover:opacity-80 text-white' }}"
                >
                    <span>🏠</span><span>Dashboard</span>
                </a>

                <a
                    href="{{ route('jadwal.index') }}"
                    class="flex items-center space-x-2 px-4 py-2 rounded
                        {{ request()->routeIs('jadwal.index') ? 'bg-white text-black' : 'hover:opacity-80 text-white' }}"
                >
                    <span>📅</span><span>Jadwal Kuliah</span>
                </a>

                <a
                    href="{{ route('jadwal.create') }}"
                    class="flex items-center space-x-2 px-4 py-2 rounded
                        {{ request()->routeIs('jadwal.create') ? 'bg-white text-black' : 'hover:opacity-80 text-white' }}"
                >
                    <span>➕</span><span>Tambah Jadwal</span>
                </a>
            </nav>
        </aside>

        <!-- Main content -->
        <div
            :class="sidebarOpen ? 'ml-64' : 'ml-0'"
            class="flex-1 flex flex-col transition-all duration-300 ease-in-out"
        >
            <!-- Top bar / header -->
            <header
                class="bg-white shadow flex items-center justify-between px-6 py-4"
            >
                <!-- Hamburger toggle button to open sidebar -->
                <button
                    @click="sidebarOpen = true"
                    x-show="!sidebarOpen"
                    class="text-gray-700 focus:outline-none"
                    aria-label="Open sidebar"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-6 w-6"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <line x1="3" y1="6" x2="21" y2="6" />
                        <line x1="3" y1="12" x2="21" y2="12" />
                        <line x1="3" y1="18" x2="21" y2="18" />
                    </svg>
                </button>

                <div>{{ $header ?? '' }}</div>
            </header>

            <!-- Page content -->
            <main class="flex-1">{{ $slot }}</main>
        </div>
    </div>
</body>
</html>
