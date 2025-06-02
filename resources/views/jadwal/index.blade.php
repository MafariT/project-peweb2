<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Jadwal Kuliah') }}
        </h2>
    </x-slot>

    <style>
        .jadwal-cell {
            @apply bg-gradient-to-br from-blue-100 to-blue-50 text-blue-900 rounded-md shadow-sm p-2 text-sm flex flex-col justify-between h-full;
        }

        thead th { position: sticky; top: 0; z-index: 10; }
        tbody td:first-child { position: sticky; left: 0; background-color: #fff; z-index: 5; }
        tbody tr:hover td { background-color: #e0f2fe; }
        .schedule-container { overflow-x: auto; }

        @media (max-width: 640px) {
            td, th { font-size: 0.75rem; padding: 0.25rem; }
        }
    </style>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Filters -->
            <form method="GET" class="mb-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                    <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                    <select name="hari" id="hari" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Semua</option>
                        @foreach ($days as $day)
                            <option value="{{ $day }}" @selected($filterHari === $day)>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="dosen" class="block text-sm font-medium text-gray-700">Dosen</label>
                    <select name="dosen" id="dosen" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Semua</option>
                        @foreach ($dosenList as $dosen)
                            <option value="{{ $dosen }}" @selected($filterDosen === $dosen)>{{ $dosen }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="mata_kuliah" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                    <select name="mata_kuliah" id="mata_kuliah" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Semua</option>
                        @foreach ($mataKuliahList as $mk)
                            <option value="{{ $mk }}" @selected($filterMataKuliah === $mk)>{{ $mk }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-3 flex justify-end gap-3 items-end mt-2">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Filter
                    </button>
                    <a href="{{ route('jadwal.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">
                        Reset
                    </a>
                </div>
            </form>

            <!-- Schedule Table -->
            <div class="schedule-container rounded-lg border border-gray-300 shadow-sm">
                <table class="min-w-full table-fixed border-collapse border border-gray-300">
                    <thead class="bg-blue-600 text-white">
                        <tr>
                            <th class="w-20 sm:w-24 border border-blue-700 px-2 sm:px-3 py-2 text-center text-xs sm:text-sm font-semibold uppercase tracking-wide">
                                Waktu / Hari
                            </th>
                            @foreach ($days as $day)
                                <th class="w-28 sm:w-40 border border-blue-700 px-2 sm:px-3 py-2 text-center text-xs sm:text-sm font-semibold uppercase tracking-wide">
                                    {{ $day }}
                                </th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $skipSlots = [];
                            foreach ($days as $day) {
                                $skipSlots[$day] = [];
                            }
                        @endphp

                        @foreach ($wholeHourSlots as $hourIndex => $slot)
                            <tr>
                                <td class="sticky left-0 bg-white border-r border-gray-300 px-2 py-2 text-xs font-mono font-semibold text-gray-700">
                                    {{ substr($slot, 0, 5) }}
                                </td>

                                @foreach ($days as $day)
                                    @if (in_array($hourIndex, $skipSlots[$day], true))
                                        @continue
                                    @endif

                                    @php
                                        $jadwalAtSlot = $filteredJadwals->first(fn($j) => $j->hari === $day && $roundDownToHour($j->jam_mulai) === $slot);
                                    @endphp

                                    @if ($jadwalAtSlot)
                                        @php
                                            $span = max(1, ceil($slotSpan($jadwalAtSlot->jam_mulai, $jadwalAtSlot->jam_selesai) * $intervalMinutes / 60));
                                            for ($i = 1; $i < $span; $i++) {
                                                $skipSlots[$day][] = $hourIndex + $i;
                                            }
                                        @endphp
                                        <td rowspan="{{ $span }}" class="border border-blue-300 align-top h-[72px] jadwal-cell">
                                            <div class="font-semibold truncate">{{ $jadwalAtSlot->mata_kuliah }}</div>
                                            <div class="text-xs italic text-blue-800 truncate">{{ $jadwalAtSlot->dosen }}</div>
                                            <div class="text-xs text-blue-700 truncate">{{ $jadwalAtSlot->ruangan }}</div>
                                            <div class="text-xs text-blue-600 mt-1 font-mono whitespace-nowrap">
                                                {{ substr($jadwalAtSlot->jam_mulai, 0, 5) }} - {{ substr($jadwalAtSlot->jam_selesai, 0, 5) }}
                                            </div>
                                        </td>
                                    @else
                                        <td class="border border-gray-300 px-1 h-[72px] bg-white"></td>
                                    @endif
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
