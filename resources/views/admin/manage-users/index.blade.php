<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>

    <div class="py-6 px-4 max-w-7xl mx-auto">

        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('admin.manage-users.create') }}" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition">
                Tambah Pengguna
            </a>

            <form method="GET" action="{{ route('admin.manage-users.index') }}" class="flex items-center space-x-2">
                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Cari pengguna..."
                    class="px-4 py-2 rounded border border-gray-600 bg-gray-800 text-white focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                <button
                    type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded transition"
                >
                    Cari
                </button>
            </form>
        </div>

        <div class="overflow-x-auto mt-6 rounded-xl shadow-lg border border-gray-700">
            <table class="min-w-full table-auto text-left text-sm sm:text-base text-white">
                <thead class="bg-gray-700 text-xs sm:text-sm uppercase">
                    <tr>
                        <th class="px-4 py-3 font-semibold">Nama</th>
                        <th class="px-4 py-3 font-semibold">Email</th>
                        <th class="px-4 py-3 font-semibold">Username</th>
                        <th class="px-4 py-3 font-semibold">Role</th>
                        <th class="px-4 py-3 font-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-gray-800 divide-y divide-gray-700">
                    @forelse ($users as $user)
                        <tr class="hover:bg-gray-700 transition-colors">
                            <td class="px-4 py-3 break-words">{{ $user->name }}</td>
                            <td class="px-4 py-3 break-words">{{ $user->email }}</td>
                            <td class="px-4 py-3 break-words">{{ $user->username }}</td>
                            <td class="px-4 py-3 capitalize">{{ $user->role }}</td>
                            <td class="px-4 py-3 space-x-2 whitespace-nowrap">
                                <a href="{{ route('admin.manage-users.edit', $user) }}" class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-sm transition">Ubah</a>

                                <form action="{{ route('admin.manage-users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus pengguna ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-gray-400 py-6">Tidak ada pengguna ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-sidebar-layout>
