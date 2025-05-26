<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Jadwal') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <!-- Modal Trigger Button -->
        <button
            onclick="document.getElementById('jadwalModal').classList.remove('hidden')"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded"
        >
            Tambah Jadwal
        </button>

        <!-- Modal -->
        <div id="jadwalModal" class="fixed inset-0 flex items-center justify-center hidden">
            <div class="bg-white p-6 rounded-lg w-full max-w-xl relative">
                <!-- Close Button -->
                <button
                    onclick="document.getElementById('jadwalModal').classList.add('hidden')"
                    class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl"
                >
                    &times;
                </button>

                <h2 class="text-lg font-bold mb-4">Tambah Jadwal</h2>
                <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @include('jadwal._form')
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="overflow-x-auto mt-6">
            <table class="w-full table-auto text-left text-sm text-white">
                <thead class="bg-gray-700 uppercase text-xs">
                    <tr>
                        <th class="px-4 py-2">Mata Kuliah</th>
                        <th class="px-4 py-2">Dosen</th>
                        <th class="px-4 py-2">Hari</th>
                        <th class="px-4 py-2">Jam</th>
                        <th class="px-4 py-2">Ruangan</th>
                        <th class="px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @foreach ($jadwals as $jadwal)
                        <tr>
                            <td class="px-4 py-2">{{ $jadwal->mata_kuliah }}</td>
                            <td class="px-4 py-2">{{ $jadwal->dosen }}</td>
                            <td class="px-4 py-2">{{ $jadwal->hari }}</td>
                            <td class="px-4 py-2">{{ $jadwal->jam_mulai }} - {{ $jadwal->jam_selesai }}</td>
                            <td class="px-4 py-2">{{ $jadwal->ruangan }}</td>
                            <td class="px-4 py-2 space-x-2">
                                <a href="{{ route('jadwal.edit', $jadwal) }}" class="text-blue-400 hover:underline">Edit</a>
                                <form action="{{ route('jadwal.destroy', $jadwal) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($jadwals->isEmpty())
                        <tr>
                            <td colspan="6" class="text-center text-gray-400 py-4">Tidak ada data jadwal.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
