<form action="{{ isset($user) ? route('admin.manage-users.update', $user) : route('admin.manage-users.store') }}" method="POST" class="space-y-4 max-w-md">
    @csrf
    @if(isset($user)) @method('PUT') @endif

    <div>
        <label class="block text-sm mb-1" for="name">Nama</label>
        <input id="name" name="name" type="text" class="w-full rounded border border-gray-700 p-2" value="{{ old('name', $user->name ?? '') }}" required>
    </div>

    <div>
        <label class="block text-sm mb-1" for="email">Email</label>
        <input id="email" name="email" type="email" class="w-full rounded border border-gray-700 p-2" value="{{ old('email', $user->email ?? '') }}" required>
    </div>

    <div>
        <label class="block text-sm mb-1" for="username">Username</label>
        <input id="username" name="username" type="text" class="w-full rounded border border-gray-700 p-2" value="{{ old('username', $user->username ?? '') }}" required>
    </div>

    <div>
        <label class="block text-sm mb-1" for="role">Role</label>
        <select id="role" name="role" class="w-full rounded border border-gray-700 p-2" required>
            <option value="default" {{ (old('role', $user->role ?? '') === 'default') ? 'selected' : '' }}>Default</option>
            <option value="admin" {{ (old('role', $user->role ?? '') === 'admin') ? 'selected' : '' }}>Admin</option>
        </select>
    </div>

    <div>
        <label class="block text-sm mb-1" for="password">{{ isset($user) ? 'Password Baru (kosongkan jika tidak ingin diubah)' : 'Password' }}</label>
        <input id="password" name="password" type="password" class="w-full rounded border border-gray-700 p-2" {{ isset($user) ? '' : 'required' }}>
    </div>

    <div>
        <label class="block text-sm mb-1" for="password_confirmation">Konfirmasi Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="w-full rounded border border-gray-700 p-2" {{ isset($user) ? '' : 'required' }}>
    </div>

    <div class="flex justify-end">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            Simpan
        </button>
    </div>
</form>
