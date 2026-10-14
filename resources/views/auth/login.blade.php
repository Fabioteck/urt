@extends('layouts.public')

@section('content')
<div class="max-w-md mx-auto px-4 py-24">
    <div class="bg-zinc-950/90 backdrop-blur border border-zinc-800 rounded-xl p-8 shadow-2xl space-y-6">
        <div class="text-center space-y-2">
            <h1 class="text-2xl font-black text-white uppercase font-mono tracking-wider">Accesso Area Riservata</h1>
            <p class="text-xs font-mono text-zinc-400">Inserisci le credenziali di accesso al sistema U.R.T.</p>
        </div>

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

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <!-- Email Address -->
            <div>
                <label for="email" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">{{ __('Email') }}</label>
                <input id="email" class="block w-full bg-black border border-zinc-800 rounded-md text-white px-3 py-2.5 focus:border-red-600 focus:ring-red-600 font-mono text-sm shadow-sm" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block font-mono text-xs text-gray-300 uppercase tracking-wider mb-1">{{ __('Password') }}</label>
                <input id="password" class="block w-full bg-black border border-zinc-800 rounded-md text-white px-3 py-2.5 focus:border-red-600 focus:ring-red-600 font-mono text-sm shadow-sm"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded bg-black border-zinc-800 text-red-600 shadow-sm focus:ring-red-600" name="remember">
                    <span class="ms-2 font-mono text-xs text-zinc-400">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="underline font-mono text-xs text-zinc-400 hover:text-zinc-100 focus:outline-none" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-red-600 border border-transparent rounded-md font-mono text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-800 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150 font-bold">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
