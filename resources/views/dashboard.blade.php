<x-app-layout>
    {{-- <div class="hidden sm:flex sm:items-center absolute top-4 right-4 z-50">
    <x-dropdown align="right" width="48">
        <x-slot name="trigger">
            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                <div>{{ Auth::user()->name }}</div>

                <div class="ms-1">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </button>
        </x-slot>

        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </x-slot>
    </x-dropdown>
    </div> --}}


    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}</h1>
                <p class="text-gray-600 mt-1">Siap-siap ngatur jadwal kuliah minggu ini yuk!</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-100 text-center p-6 rounded-lg shadow">
                    <p class="text-3xl font-extrabold">12</p>
                    <p class="mt-1 text-gray-700">Jumlah Mata Kuliah</p>
                </div>
                <div class="bg-orange-100 text-center p-6 rounded-lg shadow">
                    <p class="text-3xl font-extrabold">6</p>
                    <p class="mt-1 text-gray-700">Jumlah Dosen</p>
                </div>
                <div class="bg-green-100 text-center p-6 rounded-lg shadow">
                    <p class="text-3xl font-extrabold">11</p>
                    <p class="mt-1 text-gray-700">Jadwal Minggu Ini</p>
                </div>
                <div class="bg-pink-100 text-center p-6 rounded-lg shadow">
                    <p class="text-3xl font-extrabold">5</p>
                    <p class="mt-1 text-gray-700">Total Ruangan</p>
                </div>
            </div>

            <div class="text-center text-gray-700 text-lg mt-6">
                Antara kelas dan kasur, <br class="sm:hidden" />
                kadang pilihan berat~ <span class="inline-block">⭐</span>
            </div>
        </div>
    </div>
</x-app-layout>
