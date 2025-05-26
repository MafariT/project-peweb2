<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Kuliah') }}
        </h2>
    </x-slot>

    @php
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        // Find earliest start and latest end time from $jadwals
        $earliestStart = null;
        $latestEnd = null;

        foreach ($jadwals as $jadwal) {
            if (is_null($earliestStart) || strtotime($jadwal->jam_mulai) < strtotime($earliestStart)) {
                $earliestStart = $jadwal->jam_mulai;
            }
            if (is_null($latestEnd) || strtotime($jadwal->jam_selesai) > strtotime($latestEnd)) {
                $latestEnd = $jadwal->jam_selesai;
            }
        }

        // Round earliestStart down to nearest hour
        $startTimestamp = strtotime(date('H:00:00', strtotime($earliestStart)));

        // Round latestEnd up to nearest hour correctly
        $latestEndTime = strtotime($latestEnd);
        $endHour = (int) date('H', $latestEndTime);
        $endMinute = (int) date('i', $latestEndTime);
        if ($endMinute > 0) {
            $endHour++;
        }
        $endTimestamp = strtotime(sprintf('%02d:00:00', $endHour));

        $intervalMinutes = 10;
        $timeSlots = [];
        for ($time = $startTimestamp; $time <= $endTimestamp; $time += $intervalMinutes * 60) {
            $timeSlots[] = date('H:i:s', $time);
        }

        // Filter only whole hour slots (minutes == 00)
        $wholeHourSlots = array_filter($timeSlots, function($time) {
            return substr($time, 3, 2) === '00';
        });
        // Reindex keys (important!)
        $wholeHourSlots = array_values($wholeHourSlots);

        function timeToMinutes($time) {
            list($h, $m, $s) = explode(':', $time);
            return intval($h) * 60 + intval($m);
        }

        function slotSpan($start, $end, $interval = 10) {
            $duration = timeToMinutes($end) - timeToMinutes($start);
            return max(1, intval(round($duration / $interval)));
        }

        // Round a time string down to the nearest hour (returns "HH:00:00")
        function roundDownToHour($time) {
            return date('H:00:00', strtotime($time));
        }
    @endphp

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 overflow-auto">
            <table class="min-w-full border border-gray-300 border-collapse table-auto">
                <thead class="bg-gray-100 sticky top-0 z-20">
                    <tr>
                        <th class="border border-gray-300 p-2 sticky left-0 bg-gray-100 z-30 text-left font-medium text-sm">Waktu / Hari</th>
                        @foreach ($days as $day)
                            <th class="border border-gray-300 p-2 text-center font-medium text-sm">{{ $day }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @php
                        // For skipping rows per day by index of wholeHourSlots (not timeSlots)
                        $skipSlots = [];
                        foreach ($days as $day) {
                            $skipSlots[$day] = [];
                        }
                    @endphp

                    @foreach ($wholeHourSlots as $hourIndex => $slot)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2 sticky left-0 bg-white font-mono text-xs font-semibold text-gray-700">
                                {{ substr($slot, 0, 5) }}
                            </td>

                            @foreach ($days as $day)
                                @if (in_array($hourIndex, $skipSlots[$day], true))
                                    @continue
                                @endif

                                @php
                                    $jadwalAtSlot = null;
                                    foreach ($jadwals as $jadwal) {
                                        if ($jadwal->hari === $day) {
                                            if (roundDownToHour($jadwal->jam_mulai) === $slot) {
                                                $jadwalAtSlot = $jadwal;
                                                break;
                                            }
                                        }
                                    }
                                @endphp

                                @if ($jadwalAtSlot)
                                    @php
                                        $spanIn10Min = slotSpan($jadwalAtSlot->jam_mulai, $jadwalAtSlot->jam_selesai, $intervalMinutes);
                                        // Convert 10-min spans to hour spans (since we show only whole hour rows)
                                        $spanInHours = max(1, intval(ceil($spanIn10Min * $intervalMinutes / 60)));

                                        for ($i = 1; $i < $spanInHours; $i++) {
                                            $skipIndex = $hourIndex + $i;
                                            if (isset($wholeHourSlots[$skipIndex])) {
                                                $skipSlots[$day][] = $skipIndex;
                                            }
                                        }
                                    @endphp
                                    <td rowspan="{{ $spanInHours }}"
                                        class="border border-gray-300 p-3 align-top min-w-[160px] h-[80px] bg-blue-100 text-blue-900 rounded-lg font-semibold shadow-sm">
                                        <div class="truncate">{{ $jadwalAtSlot->mata_kuliah }}</div>
                                        <div class="italic text-blue-800 text-xs mt-1 truncate">{{ $jadwalAtSlot->dosen }}</div>
                                        <div class="text-blue-700 text-xs truncate">{{ $jadwalAtSlot->ruangan }}</div>
                                        <div class="text-blue-600 text-xs mt-1">
                                            {{ substr($jadwalAtSlot->jam_mulai, 0, 5) }} - {{ substr($jadwalAtSlot->jam_selesai, 0, 5) }}
                                        </div>
                                    </td>
                                @else
                                    <td class="border border-gray-300 p-1 min-w-[160px] h-[80px] bg-white"></td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
