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
            <a href="{{ route('login') }}">PlanMyClass</a>
        </div>
        <nav>
            <a href="{{ route('login') }}" class="text-white hover:text-teal-400 transition">Login</a>
        </nav>
    </header>

    <main class="flex flex-col items-center justify-center text-center px-4 md:px-12 mt-12">
        <!-- Logo -->
        <a href="/" class="mb-6">
            <x-application-logo class="w-[300px] h-auto fill-current text-white" />
        </a>

        <!-- Heading -->
        <h1 class="text-4xl md:text-5xl font-semibold leading-tight mb-6">
            Atur Jadwal Mingguan Anda
        </h1>

        <!-- Description -->
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mb-8">
            Kelola dan lihat jadwal kuliah mingguanmu dengan mudah dan cepat. Cukup login dan mulai rencanakan jadwalmu!
        </p>

        <!-- CTA Button -->
        <a href="{{ route('register') }}" class="bg-teal-600 hover:bg-teal-700 text-white px-6 py-3 rounded-lg text-lg transition">
            Mulai Sekarang
        </a>
    </main>

    <!-- Footer -->
    <footer class="mt-16 text-sm text-center text-gray-400 px-4">
        &copy; {{ date('Y') }} PlanMyClass. All rights reserved.
    </footer>

</body>
</html>
