<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jadwal Kuliah') }}
        </h2>
    </x-slot>

    @php
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        $timeSlots = [
            '07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00',
            '12:00:00', '13:00:00', '14:00:00', '15:00:00', '16:00:00',
            '17:00:00', '18:00:00',
        ];

        function timeToMinutes($time) {
            list($h, $m, $s) = explode(':', $time);
            return intval($h) * 60 + intval($m);
        }

        function slotSpan($start, $end) {
            $duration = timeToMinutes($end) - timeToMinutes($start);
            return max(1, intval(round($duration / 60)));
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
                        $skipSlots = [];
                        foreach ($days as $day) {
                            $skipSlots[$day] = [];
                        }
                    @endphp

                    @foreach ($timeSlots as $slotIndex => $slot)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 p-2 sticky left-0 bg-white font-mono text-xs font-semibold text-gray-700">
                                {{ substr($slot, 0, 5) }}
                            </td>

                            @foreach ($days as $day)
                                @php
                                    if (in_array($slotIndex, $skipSlots[$day])) {
                                        // Do NOT print <td> here because it's covered by rowspan from above
                                        continue;
                                    }

                                    $jadwalAtSlot = null;
                                    foreach ($jadwals as $jadwal) {
                                        if ($jadwal->hari === $day && $jadwal->jam_mulai === $slot) {
                                            $jadwalAtSlot = $jadwal;
                                            break;
                                        }
                                    }
                                @endphp

                                @if ($jadwalAtSlot)
                                    @php
                                        $span = slotSpan($jadwalAtSlot->jam_mulai, $jadwalAtSlot->jam_selesai);
                                        for ($i = 1; $i < $span; $i++) {
                                            $skipSlots[$day][] = $slotIndex + $i;
                                        }
                                    @endphp
                                    <td rowspan="{{ $span }}"
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
