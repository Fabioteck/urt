<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Underground Remind Tek') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            body { font-family: 'Space Mono', monospace; background-color: #000; }
        </style>
    </head>
    <body class="font-mono text-gray-100 bg-black antialiased selection:bg-red-600 selection:text-white min-h-screen flex flex-col justify-between relative overflow-x-hidden">
        <!-- Global Interactive Particles Canvas -->
        <canvas id="particles" class="fixed inset-0 w-full h-full z-0 pointer-events-none"></canvas>

        <div class="relative z-10 flex flex-col min-h-screen justify-between">
            @auth
            <header class="border-b border-zinc-800 bg-zinc-950/90 backdrop-blur sticky top-0 z-50">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3 text-white uppercase font-mono tracking-wider">
                        <img src="{{ asset('img/favicon-ready.png') }}" alt="U.R.T. Logo" class="h-8 w-8 object-contain">
                        <span class="text-xs md:text-sm font-bold tracking-widest text-zinc-100">UNDERGROUND REMIND TEK</span>
                    </a>

                    <!-- Desktop Nav -->
                    <nav class="hidden md:flex items-center space-x-6 text-xs uppercase tracking-wider font-mono">
                        <a href="{{ route('admin.dashboard') }}" class="hover:text-red-500 transition">Dashboard</a>
                        <a href="{{ route('admin.artists.index') }}" class="hover:text-red-500 transition">Artisti</a>
                        <a href="{{ route('admin.news.index') }}" class="hover:text-red-500 transition">News</a>
                        <a href="{{ route('admin.pages.index') }}" class="hover:text-red-500 transition">Pagine</a>
                        <a href="{{ route('home') }}" class="text-zinc-400 hover:text-white transition">Sito Pubblico</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-400 font-bold">Logout</button>
                        </form>
                    </nav>

                    <!-- Mobile Hamburger -->
                    <button id="admin-menu-button" class="block md:hidden text-zinc-400 hover:text-white focus:outline-none p-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>

                <!-- Mobile Nav Dropdown -->
                <div id="admin-mobile-menu" class="hidden md:hidden bg-zinc-950/95 border-b border-zinc-800 px-4 pt-2 pb-4 space-y-2 text-xs uppercase font-mono">
                    <a href="{{ route('admin.dashboard') }}" class="block py-2 text-zinc-200 hover:text-red-500">Dashboard</a>
                    <a href="{{ route('admin.artists.index') }}" class="block py-2 text-zinc-200 hover:text-red-500">Artisti</a>
                    <a href="{{ route('admin.news.index') }}" class="block py-2 text-zinc-200 hover:text-red-500">News</a>
                    <a href="{{ route('admin.pages.index') }}" class="block py-2 text-zinc-200 hover:text-red-500">Pagine</a>
                    <a href="{{ route('home') }}" class="block py-2 text-zinc-400 hover:text-white">Sito Pubblico</a>
                    <form method="POST" action="{{ route('logout') }}" class="block pt-2 border-t border-zinc-800">
                        @csrf
                        <button type="submit" class="text-red-500 font-bold w-full text-left">Logout</button>
                    </form>
                </div>
            </header>
            @endauth

            <div class="flex-grow flex flex-col sm:justify-center items-center py-8 sm:py-16 px-4 bg-transparent">
                <div class="w-full max-w-2xl mt-6 px-6 py-6 bg-zinc-900/90 backdrop-blur border border-zinc-800 shadow-2xl overflow-hidden sm:rounded-lg">
                    {{ $slot }}
                </div>
            </div>

            <footer class="border-t border-zinc-900 bg-black/90 py-4 text-center text-xs text-zinc-600 font-mono">
                UNDERGROUND REMIND TEK Admin Console &copy; {{ date('Y') }}
            </footer>
        </div>

        <!-- Global Canvas & Pac-Man Animation Script -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const canvas = document.getElementById('particles');
                if (!canvas) return;
                const ctx = canvas.getContext('2d');

                function resize() {
                    canvas.width = window.innerWidth;
                    canvas.height = window.innerHeight;
                }
                resize();
                window.addEventListener('resize', resize);

                const particlesArray = [];
                const numberOfParticles = 60;

                class Particle {
                    constructor() {
                        this.x = Math.random() * canvas.width;
                        this.y = Math.random() * canvas.height;
                        this.size = Math.random() * 3 + 1;
                        this.speedX = (Math.random() - 0.5) * 1.2;
                        this.speedY = (Math.random() - 0.5) * 1.2;
                    }
                    update() {
                        this.x += this.speedX;
                        this.y += this.speedY;

                        if (this.x < 0 || this.x > canvas.width) this.speedX = -this.speedX;
                        if (this.y < 0 || this.y > canvas.height) this.speedY = -this.speedY;
                    }
                    draw() {
                        ctx.fillStyle = 'rgba(220, 38, 38, 0.4)';
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                        ctx.fill();
                    }
                }

                class Pacman {
                    constructor() {
                        this.reset();
                    }
                    reset() {
                        this.radius = 22;
                        this.x = window.innerWidth + 50;
                        this.y = Math.random() * (window.innerHeight - 100) + 50;
                        this.speedX = 1.5;
                    }
                    update() {
                        this.x -= this.speedX;
                        if (this.x < -50) {
                            this.reset();
                        }
                    }
                    draw(frameCount) {
                        ctx.save();
                        ctx.translate(this.x, this.y);
                        const mouthAngle = Math.abs(Math.sin(frameCount * 0.15)) * 0.45;
                        ctx.fillStyle = 'rgba(220, 38, 38, 0.8)';
                        ctx.beginPath();
                        ctx.arc(0, 0, this.radius, Math.PI + mouthAngle, Math.PI - mouthAngle, false);
                        ctx.lineTo(0, 0);
                        ctx.closePath();
                        ctx.fill();
                        ctx.restore();
                    }
                }

                for (let i = 0; i < numberOfParticles; i++) {
                    particlesArray.push(new Particle());
                }

                const pacman = new Pacman();
                let frameCount = 0;

                function animate() {
                    frameCount++;
                    ctx.clearRect(0, 0, canvas.width, canvas.height);

                    for (let i = 0; i < particlesArray.length; i++) {
                        particlesArray[i].update();
                        particlesArray[i].draw();

                        const dx = particlesArray[i].x - pacman.x;
                        const dy = particlesArray[i].y - pacman.y;
                        const distance = Math.sqrt(dx * dx + dy * dy);
                        if (distance < pacman.radius + particlesArray[i].size) {
                            particlesArray[i].x = Math.random() * canvas.width;
                            particlesArray[i].y = Math.random() * canvas.height;
                        }
                    }

                    pacman.update();
                    pacman.draw(frameCount);

                    requestAnimationFrame(animate);
                }
                animate();

                // Admin mobile menu toggle
                var adminBtn = document.getElementById('admin-menu-button');
                if (adminBtn) {
                    adminBtn.addEventListener('click', function() {
                        var menu = document.getElementById('admin-mobile-menu');
                        if (menu) menu.classList.toggle('hidden');
                    });
                }
            });
        </script>
    </body>
</html>
