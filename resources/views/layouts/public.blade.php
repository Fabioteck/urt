<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'U.R.T. - Underground Remind Tek')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-black text-zinc-100 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-red-600 selection:text-white">
    <header class="border-b border-zinc-900 bg-black/90 backdrop-blur sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center text-2xl font-black tracking-widest text-red-600 uppercase">
                <img src="{{ asset('img/favicon-ready.png') }}" alt="U.R.T. Logo" class="h-8 w-8 inline-block mr-2 object-contain">
                U.R.T. <span class="text-xs text-zinc-500 block tracking-normal font-normal ml-2">Underground Remind Tek</span>
            </a>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold tracking-wider uppercase">
                <a href="{{ route('home') }}" class="hover:text-red-500 transition">Home</a>
                <a href="{{ route('artists.index') }}" class="hover:text-red-500 transition">Artisti</a>
                <a href="{{ route('news.index') }}" class="hover:text-red-500 transition">News</a>
                <a href="{{ route('pages.show', 'progetto') }}" class="hover:text-red-500 transition">Progetto</a>
                <a href="{{ route('pages.show', 'contatti') }}" class="hover:text-red-500 transition">Contatti</a>
                @auth
                    <a href="{{ route('admin.dashboard') }}" class="text-red-500 border border-red-600 px-3 py-1 rounded hover:bg-red-600 hover:text-white transition">Admin Panel</a>
                @else
                    <a href="{{ route('login') }}" class="text-zinc-400 hover:text-white transition">Login</a>
                @endauth
            </nav>

            <!-- Mobile Hamburger Button -->
            <button id="mobile-menu-button" class="md:hidden text-zinc-400 hover:text-white focus:outline-none p-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>

        <!-- Mobile Menu Dropdown -->
        <div id="mobile-menu" class="hidden md:hidden bg-zinc-950 border-b border-zinc-900 px-4 pt-2 pb-6 space-y-3 font-mono text-sm">
            <a href="{{ route('home') }}" class="block py-2 text-zinc-300 hover:text-red-500">Home</a>
            <a href="{{ route('artists.index') }}" class="block py-2 text-zinc-300 hover:text-red-500">Artisti</a>
            <a href="{{ route('news.index') }}" class="block py-2 text-zinc-300 hover:text-red-500">News</a>
            <a href="{{ route('pages.show', 'progetto') }}" class="block py-2 text-zinc-300 hover:text-red-500">Progetto</a>
            <a href="{{ route('pages.show', 'contatti') }}" class="block py-2 text-zinc-300 hover:text-red-500">Contatti</a>
            @auth
                <a href="{{ route('admin.dashboard') }}" class="block py-2 text-red-500 font-bold">Admin Panel</a>
            @else
                <a href="{{ route('login') }}" class="block py-2 text-zinc-400 hover:text-white">Login</a>
            @endauth
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    <footer class="border-t border-zinc-900 bg-black py-8 text-center text-xs text-zinc-500 font-mono">
        <div class="max-w-7xl mx-auto px-4 space-y-2">
            <p>Official Email: <a href="mailto:booking@urt.art" class="text-red-500 hover:underline">booking@urt.art</a></p>
            <p>&copy; {{ date('Y') }} U.R.T. (Underground Remind Tek). All rights reserved.</p>
        </div>
    </footer>

    <script>
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            var menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
