<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-red-500 font-mono text-sm" :status="session('status')" />

    @if ($errors->any())
        <div class="mb-4 p-3 bg-red-950/50 border border-red-800 rounded-md text-red-400 text-sm font-mono">
            <ul class="list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block font-mono text-sm text-gray-300 uppercase tracking-wider">{{ __('Email') }}</label>
            <input id="email" class="block mt-1 w-full bg-black border border-zinc-800 rounded-md text-white px-3 py-2 focus:border-red-600 focus:ring-red-600 font-mono text-sm shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <label for="password" class="block font-mono text-sm text-gray-300 uppercase tracking-wider">{{ __('Password') }}</label>
            <input id="password" class="block mt-1 w-full bg-black border border-zinc-800 rounded-md text-white px-3 py-2 focus:border-red-600 focus:ring-red-600 font-mono text-sm shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded bg-black border-zinc-800 text-red-600 shadow-sm focus:ring-red-600" name="remember">
                <span class="ms-2 font-mono text-sm text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            @if (Route::has('password.request'))
                <a class="underline font-mono text-xs text-gray-400 hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-600" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-mono text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Log in') }}
            </button>
        </div>
    </form>
</x-guest-layout>
