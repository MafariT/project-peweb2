<x-sidebar-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Pengguna') }}
        </h2>
    </x-slot>

    <div class="p-6 max-w-xl">
        <form action="{{ route('admin.manage-users.store') }}" method="POST" class="space-y-4">
            @csrf
            @include('admin.manage-users.partials._form')
        </form>
    </div>
</x-sidebar-admin-layout>
