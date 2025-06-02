<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Greeting -->
            <h1 class="text-2xl font-bold">Halo, {{ Auth::user()->name }}</h1>
            <p class="text-gray-400 mt-1 mb-6">Selamat datang kembali! Yuk atur jadwal kuliahmu.</p>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-blue-600 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalMataKuliah }}</p>
                    <p class="mt-2 text-sm font-medium">Mata Kuliah</p>
                </div>
                <div class="bg-orange-500 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalDosen }}</p>
                    <p class="mt-2 text-sm font-medium">Dosen</p>
                </div>
                <div class="bg-green-600 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalJadwal }}</p>
                    <p class="mt-2 text-sm font-medium">Total Jadwal</p>
                </div>
                <div class="bg-pink-500 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalRuangan }}</p>
                    <p class="mt-2 text-sm font-medium">Ruangan</p>
                </div>
            </div>

            <!-- Next Class -->
            <div class="bg-gray-900 rounded-xl p-6 mb-6 shadow-md border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Kelas Berikutnya Hari Ini</h3>
                @if ($nextClass)
                    <div class="text-white">
                        <p class="text-xl font-bold">{{ $nextClass->mata_kuliah }}</p>
                        <p class="text-sm text-gray-400">{{ $nextClass->dosen }}</p>
                        <p class="mt-2">Jam: {{ $nextClass->jam_mulai }} - {{ $nextClass->jam_selesai }}</p>
                        <p>Ruangan: {{ $nextClass->ruangan }}</p>
                    </div>
                @else
                    <p class="text-gray-500">Tidak ada kelas lagi hari ini.</p>
                @endif
            </div>

            <!-- Today's Schedule -->
            <div class="bg-gray-900 rounded-xl p-6 mb-6 shadow-md border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Jadwal Hari Ini ({{ $todayName }})</h3>
                @if ($todayClasses->isEmpty())
                    <p class="text-gray-500">Kamu tidak punya kelas hari ini.</p>
                @else
                    <ul class="space-y-4">
                        @foreach ($todayClasses->sortBy('jam_mulai') as $jadwal)
                            <li class="flex justify-between items-center bg-gray-800 p-4 rounded-lg">
                                <div>
                                    <p class="font-medium text-white">{{ $jadwal->mata_kuliah }}</p>
                                    <p class="text-sm text-gray-400">{{ $jadwal->dosen }}</p>
                                </div>
                                <div class="text-right text-sm text-gray-300">
                                    <p>{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</p>
                                    <p>Ruangan: {{ $jadwal->ruangan }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <!-- Weekly Load -->
            <div class="bg-gray-900 rounded-xl p-6 shadow-md border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4">Distribusi Jadwal Mingguan</h3>
                <div class="space-y-2">
                    @foreach ($weeklyLoad as $day => $count)
                        <div>
                            <div class="flex justify-between mb-1">
                                <span class="text-gray-300">{{ $day }}</span>
                                <span class="text-gray-400 text-sm">{{ $count }} kelas</span>
                            </div>
                            <div class="w-full bg-gray-700 rounded-full h-2.5">
                                <div class="bg-teal-500 h-2.5 rounded-full" style="width: {{ $count * 20 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</x-sidebar-layout>
