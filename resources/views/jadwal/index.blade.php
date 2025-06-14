<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900 leading-tight">
            {{ __('Jadwal Kuliah') }}
        </h2>
    </x-slot>

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
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Filter</button>
                    <a href="{{ route('jadwal.index') }}" class="px-4 py-2 bg-gray-200 text-gray-800 rounded hover:bg-gray-300">Reset</a>
                </div>
            </form>

            <!-- FullCalendar -->
            <div class="bg-white rounded-lg shadow border border-gray-200 overflow-hidden">
                <div id="calendar" class="p-2 sm:p-4"></div>
            </div>
        </div>
    </div>

    @push('styles')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet" />
    <style>
        .fc {
            font-family: 'Inter', sans-serif;
            font-size: 14px;
        }

        .fc-theme-standard .fc-scrollgrid {
            border-radius: 0.75rem;
            overflow: hidden;
        }

        .fc-scrollgrid,
        .fc-timegrid-slot,
        .fc-timegrid-axis,
        .fc-col-header-cell {
            border-color: #e5e7eb !important;
        }

        .fc-col-header-cell {
            background-color: #f9fafb;
            font-weight: 600;
            color: #374151; /* gray-700 */
            padding: 0.5rem;
        }

        .fc-timegrid-slot-label {
            color: #6b7280; /* gray-500 */
        }

        .fc-timegrid-event {
            border: none;
            border-radius: 0.5rem;
            padding: 2px 4px;
            font-weight: 500;
        }

        .fc-event-title {
            padding: 0.125rem 0.25rem;
            font-size: 0.875rem;
        }

        .fc-toolbar-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #1f2937; /* gray-800 */
        }

        .fc-button {
            background-color: #3b82f6 !important; /* blue-500 */
            border: none !important;

            font-weight: 500;
            text-transform: capitalize;
        }

        .fc-button:hover {
            background-color: #2563eb !important; /* blue-600 */
        }

        .fc-button-primary:not(:disabled).fc-button-active,
        .fc-button-primary:not(:disabled):active {
            background-color: #1d4ed8 !important; /* blue-700 */
        }

        .fc-col-header-cell {
            background-color: #3b82f6 !important; /* blue-500 */
            color: #fff !important;
            font-weight: 600;
        }

        .fc-theme-standard td,
        .fc-theme-standard th {
            border-color: #93c5fd !important;
            border-left: 1px solid #93c5fd !important;
        }

        .fc-timegrid-slot,
        .fc-timegrid-axis,
        .fc-timegrid-slots tr,
        .fc-scrollgrid-section-body table {
            border-color: #93c5fd !important;
        }
    </style>
    @endpush


    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {
                    themeSystem: true,
                    initialView: 'timeGridWeek',
                    allDaySlot: false,
                    slotMinTime: '07:00:00',
                    slotMaxTime: '19:00:00',
                    slotDuration: '00:30:00',
                    dayHeaderFormat: { weekday: 'long' },
                    hiddenDays: [0, 6],
                    height: 'auto',
                    expandRows: true,
                    locale: 'id',
                    nowIndicator: true,
                    firstDay: 1,
                    eventColor: '#3b82f6',
                    eventTimeFormat: {
                        hour: '2-digit',
                        minute: '2-digit',
                        hour12: false
                    },
                        buttonText: {
                        today: 'Hari Ini',
                        week: 'Mingguan',
                        day: 'Harian'
                    },
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'timeGridWeek,timeGridDay'
                    },
                    events: @json($calendarEvents),

                    eventDidMount: function(info) {
                        const dosen = info.event.extendedProps.dosen;
                        if (dosen) {
                            const dosenEl = document.createElement('div');
                            dosenEl.innerHTML = `<small style=""";">${dosen}</small>`;
                            info.el.querySelector('.fc-event-title')?.appendChild(dosenEl);
                        }
                    }
                });

                calendar.render();
            });
        </script>
    @endpush

</x-sidebar-layout>
