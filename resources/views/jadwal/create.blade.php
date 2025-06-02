<x-sidebar-layout>
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
            aria-haspopup="dialog"
            aria-controls="jadwalModal"
        >
            Tambah Jadwal
        </button>

        <!-- Tambah Jadwal Modal -->
        <div id="jadwalModal"
             class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
             role="dialog"
             aria-modal="true"
             aria-labelledby="modalTitle"
        >
            <div class="bg-white rounded-lg w-full max-w-xl max-h-[90vh] overflow-y-auto p-6 relative shadow-lg">
                <!-- Close Button -->
                <button
                    onclick="document.getElementById('jadwalModal').classList.add('hidden')"
                    class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-3xl font-bold leading-none"
                    aria-label="Close modal"
                >
                    &times;
                </button>

                <h2 id="modalTitle" class="text-xl font-semibold mb-4">Tambah Jadwal</h2>

                <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-4">
                    @csrf
                    @include('jadwal.partials._form')
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal"
             class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 p-4"
             role="dialog"
             aria-modal="true"
             aria-labelledby="deleteModalTitle"
        >
            <div class="bg-white rounded-lg w-full max-w-md p-6 relative shadow-lg">
                <!-- Close Button -->
                <button
                    onclick="closeDeleteModal()"
                    class="absolute top-3 right-3 text-gray-500 hover:text-red-600 text-3xl font-bold leading-none"
                    aria-label="Close delete confirmation modal"
                >
                    &times;
                </button>

                <h2 id="deleteModalTitle" class="text-xl font-semibold mb-4">Konfirmasi Hapus</h2>
                <p class="mb-6">Yakin ingin menghapus jadwal ini?</p>

                <form id="deleteForm" method="POST" class="inline-block w-full" onsubmit="return true;">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                        <button type="submit" class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700">Hapus</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        @include('jadwal.partials._schedule-table')
    </div>

    <script>
        function openDeleteModal(actionUrl) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            form.action = actionUrl;
            modal.classList.remove('hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.add('hidden');
            const form = document.getElementById('deleteForm');
            form.action = '';
        }
    </script>
</x-sidebar-layout>
