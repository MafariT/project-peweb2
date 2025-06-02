<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-2xl font-bold text-gray-800">Halo, {{ Auth::user()->name }}</h1>
            <p class="text-gray-600 mt-1 mb-6">Siap-siap ngatur jadwal kuliah minggu ini yuk!</p>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <div class="bg-blue-600 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalMataKuliah }}</p>
                    <p class="mt-2 text-sm font-medium">Jumlah Mata Kuliah</p>
                </div>
                <div class="bg-orange-500 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalDosen }}</p>
                    <p class="mt-2 text-sm font-medium">Jumlah Dosen</p>
                </div>
                <div class="bg-green-600 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalJadwal }}</p>
                    <p class="mt-2 text-sm font-medium">Jadwal Minggu Ini</p>
                </div>
                <div class="bg-pink-500 text-white text-center p-6 rounded-xl shadow-md">
                    <p class="text-4xl font-extrabold">{{ $totalRuangan }}</p>
                    <p class="mt-2 text-sm font-medium">Total Ruangan</p>
                </div>
            </div>

            <!-- Jadwal Table -->
            @if ($jadwals->isEmpty())
                <div class="text-gray-500 text-center mt-8 text-lg">Tidak ada jadwal tersedia.</div>
            @else
                <div class="overflow-x-auto bg-gray-900 rounded-xl shadow-md mt-6 border border-gray-700">
                    <table class="w-full table-auto text-left text-sm text-white">
                        <thead class="bg-gray-700 text-xs uppercase">
                            <tr>
                                <th class="px-4 py-3 font-semibold">Mata Kuliah</th>
                                <th class="px-4 py-3 font-semibold">Dosen</th>
                                <th class="px-4 py-3 font-semibold">Hari</th>
                                <th class="px-4 py-3 font-semibold">Jam</th>
                                <th class="px-4 py-3 font-semibold">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-700">
                            @foreach ($jadwals as $jadwal)
                                <tr class="hover:bg-gray-700 transition-colors">
                                    <td class="px-4 py-3">{{ $jadwal->mata_kuliah }}</td>
                                    <td class="px-4 py-3">{{ $jadwal->dosen }}</td>
                                    <td class="px-4 py-3">{{ $jadwal->hari }}</td>
                                    <td class="px-4 py-3">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                                    <td class="px-4 py-3">{{ $jadwal->ruangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
