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
                        <button
                            type="button"
                            onclick="openDeleteModal('{{ route('jadwal.destroy', $jadwal) }}')"
                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition"
                        >
                            Hapus
                        </button>
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
