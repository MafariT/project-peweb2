<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Username -->
        <div class="mt-4">
            {{-- <x-input-label for="username" :value="__('Username')" /> --}}
            <x-text-input
                id="username"
                type="text"
                name="username"
                :value="old('username')"
                required
                autofocus
                placeholder="Username"
                autocomplete="username"
                class="w-full bg-gray-100 border border-transparent rounded px-4 py-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-600"
            />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            {{-- <x-input-label for="password" :value="__('Password')" /> --}}
            <x-text-input
                id="password"
                type="password"
                name="password"
                required
                placeholder="Password"
                autocomplete="current-password"
                class="w-full bg-gray-100 border border-transparent rounded px-4 py-3 text-gray-800 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-teal-600"
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Button -->
        <div class="mt-6">
            <x-primary-button class="w-full justify-center">
                Masuk
            </x-primary-button>
        </div>

        <!-- Forgot Password -->
        @if (Route::has('password.request'))
            <div class="mt-4 text-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Lupa sandi?
                </a>
            </div>
        @endif
    </form>
</x-guest-layout>
