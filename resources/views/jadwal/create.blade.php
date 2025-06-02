<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal') }}
        </h2>
    </x-slot>

    <div class="p-4 sm:p-6">
        <!-- Modal Trigger Button -->
        <button
            onclick="document.getElementById('jadwalModal').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded w-full sm:w-auto"
        >
            Tambah Jadwal
        </button>

        <!-- Modal -->
        <div id="jadwalModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden p-4 z-50">
            <div class="bg-white p-6 rounded-lg w-full max-w-xl max-h-[90vh] overflow-y-auto relative">
                <!-- Close Button -->
                <button
                    onclick="document.getElementById('jadwalModal').classList.add('hidden')"
                    class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-2xl sm:text-xl"
                    aria-label="Close modal"
                >
                    &times;
                </button>

                <h2 class="text-lg sm:text-xl font-bold mb-4">Tambah Jadwal</h2>
                <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @include('jadwal._form')
                </form>
            </div>
        </div>

        <!-- Table Section -->
<div class="overflow-x-auto mt-6 rounded-xl shadow-lg border border-gray-700">
    <table class="min-w-full table-auto text-left text-sm sm:text-base text-white">
        <thead class="bg-gray-700 text-xs sm:text-sm uppercase">
            <tr>
                <th class="px-4 py-3 font-semibold">Mata Kuliah</th>
                <th class="px-4 py-3 font-semibold">Dosen</th>
                <th class="px-4 py-3 font-semibold">Hari</th>
                <th class="px-4 py-3 font-semibold">Jam</th>
                <th class="px-4 py-3 font-semibold">Ruangan</th>
                <th class="px-4 py-3 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="bg-gray-800 divide-y divide-gray-700">
            @forelse ($jadwals as $jadwal)
                <tr class="hover:bg-gray-700 transition-colors">
                    <td class="px-4 py-3 break-words">{{ $jadwal->mata_kuliah }}</td>
                    <td class="px-4 py-3 break-words">{{ $jadwal->dosen }}</td>
                    <td class="px-4 py-3">{{ $jadwal->hari }}</td>
                    <td class="px-4 py-3">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                    <td class="px-4 py-3">{{ $jadwal->ruangan }}</td>
                    <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                        <a href="{{ route('jadwal.edit', $jadwal) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">Edit</a>
                        <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-gray-400 py-6">Tidak ada data jadwal.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

    </div>
</x-app-layout>
