<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal') }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        @include('jadwal.partials._form', ['jadwal' => $jadwal])
    </div>
</x-sidebar-layout>
