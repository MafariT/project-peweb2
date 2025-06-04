<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight">
            {{ __('Dashboard Admin') }}
        </h2>
    </x-slot>

    <div class="py-8 px-6 space-y-10 max-w-7xl mx-auto">

        <!-- Ringkasan Statistik -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm uppercase tracking-wide font-semibold mb-2">Total Pengguna</h3>
                <p class="text-4xl font-extrabold">{{ $totalUsers }}</p>
            </div>

            <div class="bg-gradient-to-r from-green-600 to-teal-700 text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm uppercase tracking-wide font-semibold mb-2">Total Jadwal Kuliah</h3>
                <p class="text-4xl font-extrabold">{{ $totalJadwalKuliah }}</p>
            </div>

            <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white p-6 rounded-lg shadow-lg">
                <h3 class="text-sm uppercase tracking-wide font-semibold mb-2">Pendaftar Pengguna Baru (7 hari terakhir)</h3>
                <p class="text-4xl font-extrabold">{{ $recentSignups }}</p>
            </div>
        </div>

        <!-- Aktivitas Terbaru -->
        <section class="bg-gray-900 rounded-xl p-6 shadow-md border border-gray-700">
            <h4 class="text-lg font-semibold text-white mb-4">Aktivitas Terbaru</h4>
            <ul class="divide-y divide-gray-800 max-h-72 overflow-y-auto">
                @forelse ($recentActivities as $activity)
                    <li class="py-3 flex justify-between items-center">
                        <p class="text-white font-medium">{{ $activity->description }}</p>
                        <time class="text-gray-400 text-sm whitespace-nowrap">{{ $activity->created_at->diffForHumans() }}</time>
                    </li>
                @empty
                    <li class="py-4 text-center text-gray-500 italic">Tidak ada aktivitas terbaru.</li>
                @endforelse
            </ul>
        </section>

        <!-- Pengguna Baru Terbaru -->
        <section class="bg-gray-900 rounded-xl p-6 shadow-md border border-gray-700">
            <h4 class="text-lg font-semibold text-white mb-4">Pengguna Baru Terbaru (7 hari terakhir)</h4>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-800 table-auto">
                    <thead class="bg-gray-900">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Nama
                            </th>
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Email
                            </th>
                            <th scope="col" class="px-6 py-3 text-center text-sm font-semibold text-gray-300 uppercase tracking-wider">
                                Total Jadwal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-800">
                        @forelse ($recentNewUsers as $user)
                            <tr class="hover:bg-gray-800 transition-colors duration-200">
                                <td class="px-6 py-4 whitespace-nowrap text-white font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-300">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-gray-300 font-semibold">{{ $user->jadwals_count }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="py-6 text-center text-gray-500 italic">Tidak ada pengguna baru dalam 7 hari terakhir.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-sidebar-layout>
