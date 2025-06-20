<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>{{ config('app.name', 'PlanMyClass') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-[#1f3d55] to-[#0f1d2b] text-white font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-gray-100 bg-[url('/public/cubes.png')] shadow-md overflow-hidden sm:rounded-lg outline outline-gray-500 outline-2">
            <!-- Logo inside container, centered and with margin-bottom -->
            <div class="flex justify-center mb-6">
                <a href="/">
                    <x-application-logo class="w-[200px] h-auto fill-current text-gray-800" />
                </a>
            </div>

            {{ $slot }}
        </div>
    </div>
</body>
</html>
