<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'U.R.T. - Underground Remind Tek')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-zinc-950 text-zinc-100 font-sans antialiased min-h-screen flex flex-col justify-between selection:bg-red-600 selection:text-white">
    <!-- Header -->
    <header class="border-b border-zinc-800 bg-zinc-900/80 backdrop-blur sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <a href="{{ route('home') }}" class="text-2xl font-black tracking-widest text-red-600 uppercase">
                U.R.T. <span class="text-xs text-zinc-400 block tracking-normal font-normal">Underground Remind Tek</span>
            </a>
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
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="border-t border-zinc-800 bg-zinc-900 py-8 text-center text-xs text-zinc-500">
        <div class="max-w-7xl mx-auto px-4">
            <p>&copy; {{ date('Y') }} U.R.T. (Underground Remind Tek). Sound System Culture. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>
