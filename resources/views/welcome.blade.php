<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Jadwal Kuliah Pribadi</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#1f3d55] to-[#0f1d2b] text-white font-sans antialiased">

    <!-- Header -->
    <header class="w-full py-6 px-4 md:px-12 flex justify-between items-center">
        <div class="text-2xl font-bold tracking-tight">
            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}">PlanMyClass</a>
        </div>
        <nav class="space-x-4">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}" class="text-white hover:text-teal-400 transition">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}" class="text-white hover:text-teal-400 transition">Profile</a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-white hover:text-teal-400 transition">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-teal-400 transition">Login</a>
                <a href="{{ route('register') }}" class="text-white hover:text-teal-400 transition">Register</a>
            @endauth
        </nav>
    </header>

    <main class="flex flex-col items-center justify-center text-center px-4 md:px-12 mt-12">
        @auth
            <!-- Content for logged-in users -->
            <h1 class="text-4xl md:text-5xl font-semibold leading-tight mb-6">
                Selamat datang, {{ auth()->user()->name }}!
            </h1>
            <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-8">
                Anda sudah login. Silakan akses dashboard Anda untuk mengatur jadwal kuliah.
            </p>
            <a href="{{ route('dashboard') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg text-lg transition">
                Buka Dashboard
            </a>
        @else
            <!-- Original landing page for guests -->
            <a href="/" class="mb-6">
                <x-application-logo class="w-[300px] h-auto fill-current text-white" />
            </a>

            <h1 class="text-4xl md:text-5xl font-semibold leading-tight mb-6">
                Atur Jadwal Mingguan Anda
            </h1>

            <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-8">
                Kelola dan lihat jadwal kuliah mingguanmu dengan mudah dan cepat. Cukup login dan mulai rencanakan jadwalmu!
            </p>

            <a href="{{ route('register') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg text-lg transition">
                Mulai Sekarang
            </a>
        @endauth
    </main>

    <!-- Footer -->
    <footer class="mt-16 text-sm text-center text-gray-400 px-4">
        &copy; {{ date('Y') }} PlanMyClass. All rights reserved.
    </footer>

</body>
</html>
