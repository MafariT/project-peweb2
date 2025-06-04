<x-sidebar-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ubah Pengguna') }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        @include('admin.manage-users.partials._form', ['user' => $user])
    </div>
</x-sidebar-layout>
