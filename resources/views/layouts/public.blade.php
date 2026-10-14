<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'U.R.T. - Underground Remind Tek')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Space+Mono:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Space Grotesk', sans-serif; background-color: #000; }
        .font-mono { font-family: 'Space Mono', monospace; }
    </style>
</head>
<body class="bg-black text-zinc-100 antialiased min-h-screen flex flex-col justify-between selection:bg-red-600 selection:text-white relative overflow-x-hidden">
    <!-- Global Interactive Particles Canvas -->
    <canvas id="particles" class="fixed inset-0 w-full h-full z-0 pointer-events-none"></canvas>

    <div class="relative z-10 flex flex-col min-h-screen justify-between">
        <header class="border-b border-zinc-900 bg-black/80 backdrop-blur sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 text-white uppercase font-mono tracking-wider">
                    <img src="{{ asset('img/favicon-ready.png') }}" alt="U.R.T. Logo" class="h-9 w-9 object-contain">
                    <span class="text-sm md:text-base font-bold tracking-widest text-zinc-100">UNDERGROUND REMIND TEK</span>
                </a>

                <!-- Desktop Nav -->
                <nav class="hidden md:flex items-center space-x-8 text-sm font-semibold tracking-wider uppercase font-mono">
                    <a href="{{ route('home') }}" class="hover:text-red-500 transition">Home</a>
                    <a href="{{ route('artists.index') }}" class="hover:text-red-500 transition">Artisti</a>
                    <a href="{{ route('news.index') }}" class="hover:text-red-500 transition">News</a>
                    @foreach(\App\Models\StaticPage::all() as $navPage)
                        <a href="{{ route('pages.show', $navPage->key) }}" class="hover:text-red-500 transition">{{ $navPage->title }}</a>
                    @endforeach
                    @auth
                        <a href="{{ route('admin.dashboard') }}" class="text-red-500 border border-red-600 px-3 py-1 rounded hover:bg-red-600 hover:text-white transition">Admin Panel</a>
                    @else
                        <a href="{{ route('login') }}" class="text-zinc-400 hover:text-white transition">Login</a>
                    @endauth
                </nav>

                <!-- Mobile Hamburger Button -->
                <button id="mobile-menu-button" class="block md:hidden text-zinc-400 hover:text-white focus:outline-none p-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Mobile Menu Dropdown -->
            <div id="mobile-menu" class="hidden md:hidden bg-zinc-950/95 border-b border-zinc-900 px-4 pt-2 pb-6 space-y-3 font-mono text-sm">
                <a href="{{ route('home') }}" class="block py-2 text-zinc-300 hover:text-red-500">Home</a>
                <a href="{{ route('artists.index') }}" class="block py-2 text-zinc-300 hover:text-red-500">Artisti</a>
                <a href="{{ route('news.index') }}" class="block py-2 text-zinc-300 hover:text-red-500">News</a>
                @foreach(\App\Models\StaticPage::all() as $navPage)
                    <a href="{{ route('pages.show', $navPage->key) }}" class="block py-2 text-zinc-300 hover:text-red-500">{{ $navPage->title }}</a>
                @endforeach
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

        <footer class="border-t border-zinc-900 bg-black/90 py-8 text-center text-xs text-zinc-600 font-mono">
            <div class="max-w-7xl mx-auto px-4">
                <p>&copy; {{ date('Y') }} UNDERGROUND REMIND TEK. All rights reserved.</p>
            </div>
        </footer>
    </div>

    @if(isset($activeVisitId))
        <script>
            setInterval(function() {
                fetch('{{ route("telemetry.ping") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ visit_id: {{ $activeVisitId }} })
                }).catch(err => console.log('Telemetry ping error:', err));
            }, 10000);
        </script>
    @endif

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

            // Mobile menu toggle
            var mobileBtn = document.getElementById('mobile-menu-button');
            if (mobileBtn) {
                mobileBtn.addEventListener('click', function() {
                    var menu = document.getElementById('mobile-menu');
                    if (menu) menu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
