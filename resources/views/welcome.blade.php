<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Jadwal Kuliah Pribadi - PlanMyClass</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#1f3d55] to-[#0f1d2b] text-white font-sans antialiased flex flex-col">

    <!-- Header -->
    <header class="w-full py-6 px-4 md:px-12 flex justify-between items-center">
        <div class="text-2xl font-extrabold tracking-tight">
            <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" aria-label="Beranda PlanMyClass" class="hover:text-teal-400 transition">
                PlanMyClass
            </a>
        </div>
        <nav class="space-x-6 text-lg" aria-label="Navigasi utama">
            @auth
                <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard') : route('dashboard') }}"
                   class="hover:text-teal-400 transition focus:outline-none focus:ring-2 focus:ring-teal-400 rounded">
                    Dashboard
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="hover:text-teal-400 transition focus:outline-none focus:ring-2 focus:ring-teal-400 rounded">
                    Profil
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                            class="hover:text-teal-400 transition focus:outline-none focus:ring-2 focus:ring-teal-400 rounded"
                            aria-label="Logout dari PlanMyClass">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                   class="hover:text-teal-400 transition focus:outline-none focus:ring-2 focus:ring-teal-400 rounded">
                    Login
                </a>
                <a href="{{ route('register') }}"
                   class="hover:text-teal-400 transition focus:outline-none focus:ring-2 focus:ring-teal-400 rounded">
                    Daftar
                </a>
            @endauth
        </nav>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col items-center justify-center text-center px-4 md:px-12 mt-16 max-w-4xl mx-auto">
        @auth
            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                Selamat datang, <span class="text-teal-400">{{ auth()->user()->name }}</span>!
            </h1>
            <p class="text-lg md:text-xl text-gray-300 mb-8">
                Anda sudah login. Silakan akses dashboard Anda untuk mengatur jadwal kuliah.
            </p>
            <a href="{{ route('dashboard') }}"
               class="inline-block bg-teal-600 hover:bg-teal-700 focus:bg-teal-700 text-white px-8 py-3 rounded-lg text-lg transition focus:outline-none focus:ring-4 focus:ring-teal-500">
                Buka Dashboard
            </a>
        @else
            <a href="/" class="mb-8" aria-label="Beranda PlanMyClass">
                <x-application-logo class="w-[300px] h-auto fill-current text-white" />
            </a>

            <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-6">
                Atur Jadwal Mingguan Anda
            </h1>

            <p class="text-lg md:text-xl text-gray-300 mb-8 max-w-xl mx-auto">
                Kelola dan lihat jadwal kuliah mingguanmu dengan mudah dan cepat. Cukup login dan mulai rencanakan jadwalmu!
            </p>

            <a href="{{ route('register') }}"
               class="inline-block bg-teal-600 hover:bg-teal-700 focus:bg-teal-700 text-white px-8 py-3 rounded-lg text-lg transition focus:outline-none focus:ring-4 focus:ring-teal-500">
                Mulai Sekarang
            </a>
        @endauth
    </main>

    <!-- Footer -->
    <footer class="mt-16 py-6 text-sm text-center text-gray-400">
        &copy; {{ date('Y') }} PlanMyClass. All rights reserved.
    </footer>

</body>
</html>
