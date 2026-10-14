<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Underground Remind Tek') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-mono text-gray-100 bg-black antialiased selection:bg-red-600 selection:text-white min-h-screen flex flex-col justify-between">
        @auth
        <header class="border-b border-zinc-800 bg-zinc-950 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center text-lg font-bold text-white uppercase tracking-wider">
                    <img src="{{ asset('img/favicon-ready.png') }}" alt="U.R.T. Logo" class="h-7 w-7 inline-block mr-2 object-contain">
                    U.R.T. <span class="text-red-500 ml-1">SYSTEM</span>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-6 text-xs uppercase tracking-wider">
                    <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500 transition">Dashboard</a>
                    <a href="{{ route('admin.artists.index') }}" class="hover:text-red-500 transition">Artisti</a>
                    <a href="{{ route('admin.news.index') }}" class="hover:text-red-500 transition">News</a>
                    <a href="{{ route('home') }}" class="text-zinc-400 hover:text-white transition">Sito Pubblico</a>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-500 hover:text-red-400 font-bold">Logout</button>
                    </form>
                </nav>

                <!-- Mobile Hamburger -->
                <button id="admin-menu-button" class="md:hidden text-zinc-400 hover:text-white focus:outline-none p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Nav Dropdown -->
            <div id="admin-mobile-menu" class="hidden md:hidden bg-zinc-900 border-b border-zinc-800 px-4 pt-2 pb-4 space-y-2 text-xs uppercase font-mono">
                <a href="{{ route('admin.dashboard') }}" class="block py-2 text-zinc-200 hover:text-red-500">Dashboard</a>
                <a href="{{ route('admin.artists.index') }}" class="block py-2 text-zinc-200 hover:text-red-500">Artisti</a>
                <a href="{{ route('admin.news.index') }}" class="block py-2 text-zinc-200 hover:text-red-500">News</a>
                <a href="{{ route('home') }}" class="block py-2 text-zinc-400 hover:text-white">Sito Pubblico</a>
                <form method="POST" action="{{ route('logout') }}" class="block pt-2 border-t border-zinc-800">
                    @csrf
                    <button type="submit" class="text-red-500 font-bold w-full text-left">Logout</button>
                </form>
            </div>
        </header>
        @endauth

        <div class="flex-grow flex flex-col sm:justify-center items-center py-6 sm:py-12 px-4 bg-black">
            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-zinc-900 border border-zinc-800 shadow-2xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>

        <footer class="border-t border-zinc-900 bg-black py-4 text-center text-xs text-zinc-600 font-mono">
            U.R.T. Admin Console &copy; {{ date('Y') }}
        </div>

        <script>
            var adminBtn = document.getElementById('admin-menu-button');
            if (adminBtn) {
                adminBtn.addEventListener('click', function() {
                    var menu = document.getElementById('admin-mobile-menu');
                    if (menu) menu.classList.toggle('hidden');
                });
            }
        </script>
    </body>
</html>
